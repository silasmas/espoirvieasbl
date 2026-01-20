# Structure de la Base de Données - Système de Gestion des Dons ONG

## Vue d'ensemble

Cette base de données est conçue pour gérer :
- Les dons spontanés et récurrents
- Les rappels par email pour les engagements de dons récurrents
- Les activités de l'ONG
- Les dépenses et la transparence financière
- Les rapports envoyés aux donateurs

## Tables principales

### 1. `donors` - Donateurs
Stocke les informations de tous les donateurs (spontanés et récurrents).

**Champs clés :**
- Informations personnelles (nom, email, téléphone, adresse)
- Préférences de communication (rapports, newsletter, anonymat)
- Statistiques (montant total donné, dernier don)

### 2. `donations` - Dons
Enregistre tous les dons effectués (spontanés et récurrents).

**Champs clés :**
- Montant et devise
- Type (one_time ou recurring)
- Statut du paiement (pending, completed, failed, refunded)
- Informations de paiement et transaction
- Gestion des reçus fiscaux

**Relations :**
- `donor_id` → `donors.id`
- `recurring_donation_id` → `recurring_donations.id` (si don récurrent)

### 3. `recurring_donations` - Dons Récurrents
Gère les abonnements de dons réguliers (mensuel, trimestriel, etc.).

**Champs clés :**
- Montant et fréquence (monthly, quarterly, biannual, annual)
- Dates de début et de fin
- Prochaine date de prélèvement
- Informations de paiement récurrent
- Statut (active, paused, cancelled, expired, failed)
- Statistiques (nombre de dons, échecs, etc.)

**Relations :**
- `donor_id` → `donors.id`

### 4. `donation_reminders` - Rappels de Dons
Gère les rappels par email envoyés aux donateurs pour leurs engagements.

**Champs clés :**
- Type de rappel (upcoming, overdue, payment_failed, renewal)
- Dates (programmée, due, envoyée)
- Statut (pending, sent, failed, cancelled)
- Suivi de l'email (ouvert, cliqué)

**Relations :**
- `recurring_donation_id` → `recurring_donations.id`
- `donor_id` → `donors.id`

### 5. `activities` - Activités
Enregistre toutes les activités et projets de l'ONG.

**Champs clés :**
- Titre, description, type (project, event, campaign, etc.)
- Dates et localisation
- Budget et montants (collecté, dépensé)
- Statut (planned, ongoing, completed, etc.)
- Résultats et impact (bénéficiaires, métriques)

### 6. `expenses` - Dépenses
Enregistre toutes les dépenses de l'ONG pour la transparence financière.

**Champs clés :**
- Montant et catégorie (program, administrative, fundraising, etc.)
- Dates (dépense, paiement)
- Informations de paiement et justificatifs
- Statut (pending, approved, paid, rejected)
- Validation par un administrateur

**Relations :**
- `activity_id` → `activities.id` (optionnel)
- `approved_by` → `admins.id` (optionnel)

### 7. `reports` - Rapports
Stocke les rapports générés pour les donateurs.

**Champs clés :**
- Type (quarterly, biannual, annual, custom)
- Période couverte (start_date, end_date)
- Contenu (HTML, résumés JSON)
- Fichiers (PDF, images)
- Statistiques (dons, dépenses, activités, bénéficiaires)
- Statut (draft, published, archived)

### 8. `donor_reports` - Rapports Envoyés aux Donateurs
Table de liaison pour suivre quels rapports ont été envoyés à quels donateurs.

**Champs clés :**
- Statut d'envoi (pending, sent, failed, bounced)
- Dates (envoyé, ouvert, cliqué, téléchargé)
- Suivi de l'engagement (email ouvert, lien cliqué, rapport consulté)
- Statistiques (nombre de vues)

**Relations :**
- `donor_id` → `donors.id`
- `report_id` → `reports.id`
- Index unique sur (`donor_id`, `report_id`) pour éviter les doublons

## Flux de données

### Dons spontanés
1. Visiteur fait un don → Création dans `donations` (type: one_time)
2. Si nouveau donateur → Création dans `donors`
3. Paiement traité → Mise à jour du statut dans `donations`
4. Reçu fiscal généré → Mise à jour dans `donations`

### Dons récurrents
1. Donateur souscrit → Création dans `recurring_donations`
2. À chaque période → Création d'un enregistrement dans `donations` (type: recurring)
3. Avant la date de prélèvement → Création d'un rappel dans `donation_reminders`
4. Rappel envoyé → Mise à jour du statut dans `donation_reminders`
5. Si échec de paiement → Notification dans `donation_reminders`

### Rapports aux donateurs
1. Rapport créé → Enregistrement dans `reports`
2. Pour chaque donateur qui souhaite recevoir des rapports → Création dans `donor_reports`
3. Email envoyé → Mise à jour du statut dans `donor_reports`
4. Suivi de l'engagement → Mise à jour des statistiques dans `donor_reports`

## Relations entre tables

```
donors (1) ──→ (N) donations
donors (1) ──→ (N) recurring_donations
recurring_donations (1) ──→ (N) donations
recurring_donations (1) ──→ (N) donation_reminders
activities (1) ──→ (N) expenses
reports (1) ──→ (N) donor_reports
donors (1) ──→ (N) donor_reports
```

## Index recommandés

Les migrations incluent déjà les index de base (clés primaires, clés étrangères, unique). 
Vous pouvez ajouter des index supplémentaires pour optimiser les requêtes fréquentes :

- `donations`: index sur `status`, `paid_at`, `type`
- `recurring_donations`: index sur `status`, `next_donation_date`
- `donation_reminders`: index sur `status`, `scheduled_date`
- `activities`: index sur `status`, `start_date`, `end_date`
- `expenses`: index sur `status`, `expense_date`, `category`
- `reports`: index sur `status`, `start_date`, `end_date`

## Notes importantes

1. **Soft Deletes** : Plusieurs tables utilisent `softDeletes()` pour conserver l'historique
2. **JSON Fields** : Certains champs utilisent JSON pour la flexibilité (metadata, images, etc.)
3. **Statuts** : Toutes les tables importantes ont des champs `status` pour gérer les workflows
4. **Dates** : Utilisation cohérente de `date()` et `timestamp()` selon le besoin
5. **Montants** : Utilisation de `decimal(15, 2)` pour la précision financière
