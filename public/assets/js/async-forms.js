/**
 * =====================================================================================
 * GESTIONNAIRE DE FORMULAIRES ASYNCHRONES
 * =====================================================================================
 * 
 * Ce fichier centralise toute la gestion des formulaires asynchrones de l'application :
 * - Formulaire de contact
 * - Formulaire d'inscription à la newsletter
 * - Formulaire de don
 * 
 * Toutes les requêtes sont effectuées via AJAX sans rechargement de page.
 * =====================================================================================
 */

(function() {
    'use strict';

    /**
     * =================================================================================
     * CONFIGURATION GLOBALE
     * =================================================================================
     */
    const config = {
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        baseUrl: window.location.origin,
    };

    /**
     * =================================================================================
     * FONCTIONS UTILITAIRES
     * =================================================================================
     */

    /**
     * Affiche une notification à l'utilisateur
     * @param {HTMLElement} container - Conteneur HTML où afficher la notification
     * @param {string} message - Message à afficher
     * @param {string} type - Type de notification : 'success', 'error', 'info'
     * @param {number} duration - Durée d'affichage en millisecondes (0 = permanent)
     */
    function showNotification(container, message, type = 'success', duration = 5000) {
        if (!container) return;

        container.textContent = message;
        container.className = `async-notification ${type}`;
        container.style.display = 'block';

        // Faire défiler automatiquement vers la notification pour attirer l'attention
        container.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

        // Cacher automatiquement la notification après la durée spécifiée
        if (duration > 0) {
            setTimeout(() => {
                container.style.display = 'none';
            }, duration);
        }
    }

    /**
     * Affiche les erreurs de validation du formulaire
     * @param {Object} errors - Objet contenant les erreurs (clé = nom du champ, valeur = tableau de messages)
     * @param {Object} fieldMap - Mapping optionnel des noms de champs vers les IDs des éléments d'erreur
     */
    function showErrors(errors, fieldMap) {
        // Effacer toutes les erreurs précédentes
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        document.querySelectorAll('input, textarea').forEach(el => el.classList.remove('error'));

        // Afficher les nouvelles erreurs
        Object.keys(errors).forEach(field => {
            // Utiliser le mapping personnalisé ou l'ID par défaut (#error-{field})
            const errorElement = document.querySelector(fieldMap[field] || `#error-${field}`);
            const inputElement = document.querySelector(`[name="${field}"]`);

            // Afficher le message d'erreur
            if (errorElement) {
                errorElement.textContent = errors[field][0];
            }

            // Ajouter la classe 'error' au champ concerné
            if (inputElement) {
                inputElement.classList.add('error');
            }
        });
    }

    /**
     * =================================================================================
     * FORMULAIRE DE CONTACT
     * =================================================================================
     */

    /**
     * Initialise et gère la soumission du formulaire de contact
     */
    function initContactForm() {
        // Chercher le formulaire de contact (peut être dans la page contact ou event-detail)
        const form = document.getElementById('contact-form') || document.getElementById('event-contact-form');
        if (!form) return;

        const submitBtn = form.querySelector('button[type="submit"]');
        const btnText = form.querySelector('#btn-text');
        // Chercher la notification (peut avoir différents IDs selon la page)
        const notification = document.getElementById('contact-notification') || 
                           document.getElementById('event-contact-notification') ||
                           form.querySelector('.async-notification') ||
                           (() => {
                               // Créer une notification si elle n'existe pas
                               const notif = document.createElement('div');
                               notif.id = 'event-contact-notification';
                               notif.className = 'async-notification';
                               notif.style.display = 'none';
                               form.insertBefore(notif, form.firstChild);
                               return notif;
                           })();

        // Écouter la soumission du formulaire
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Désactiver le bouton de soumission pour éviter les doubles envois
            if (submitBtn) {
                submitBtn.disabled = true;
                if (btnText) btnText.textContent = 'Envoi en cours...';
            }

            // Préparer les données du formulaire
            const formData = new FormData(form);
            formData.append('_token', config.csrfToken);

            // Envoyer la requête AJAX
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Succès : afficher un message de confirmation
                    showNotification(notification, data.message, 'success');
                    // Réinitialiser le formulaire
                    form.reset();
                    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
                    document.querySelectorAll('input, textarea').forEach(el => el.classList.remove('error'));
                } else {
                    // Erreur : afficher les messages d'erreur
                    if (data.errors) {
                        // Gérer les erreurs pour les deux formulaires (contact.blade.php et event-detail.blade.php)
                        const isEventForm = form.id === 'event-contact-form';
                        showErrors(data.errors, {
                            'name': isEventForm ? '#error-event-name' : '#error-name',
                            'email': isEventForm ? '#error-event-email' : '#error-email',
                            'subject': isEventForm ? '#error-event-subject' : '#error-subject',
                            'message': isEventForm ? '#error-event-message' : '#error-message'
                        });
                        showNotification(notification, data.message || 'Veuillez corriger les erreurs dans le formulaire.', 'error');
                    } else {
                        showNotification(notification, data.message || 'Une erreur est survenue. Veuillez réessayer.', 'error');
                    }
                }
            })
            .catch(error => {
                // Gérer les erreurs réseau
                console.error('Erreur:', error);
                showNotification(notification, 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer plus tard.', 'error');
            })
            .finally(() => {
                // Réactiver le bouton dans tous les cas
                if (submitBtn) {
                    submitBtn.disabled = false;
                    const btnTextElement = form.querySelector('#btn-text') || form.querySelector('#event-btn-text');
                    if (btnTextElement) btnTextElement.textContent = 'Envoyer le message';
                }
            });
        });
    }

    /**
     * =================================================================================
     * FORMULAIRE DE NEWSLETTER
     * =================================================================================
     */

    /**
     * Initialise et gère la soumission du formulaire d'inscription à la newsletter
     */
    function initNewsletterForm() {
        const form = document.querySelector('.ul-nwsltr-form');
        if (!form) return;

        const emailInput = form.querySelector('#nwsltr-email');
        const agreementCheckbox = form.querySelector('#nwsltr-agreement');
        const submitBtn = form.querySelector('button[type="submit"]');

        // Créer un conteneur de notification s'il n'existe pas
        let notification = form.querySelector('.newsletter-notification');
        if (!notification) {
            notification = document.createElement('div');
            notification.className = 'async-notification';
            notification.style.display = 'none';
            form.insertBefore(notification, form.firstChild);
        }

        // Écouter la soumission du formulaire
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validation côté client : vérifier que la case de confidentialité est cochée
            if (!agreementCheckbox.checked) {
                showNotification(notification, 'Veuillez accepter la politique de confidentialité pour vous abonner.', 'error');
                return;
            }

            // Validation côté client : vérifier que l'email est rempli
            if (!emailInput.value.trim()) {
                showNotification(notification, 'Veuillez entrer votre adresse email.', 'error');
                return;
            }

            // Désactiver le bouton de soumission
            if (submitBtn) {
                submitBtn.disabled = true;
                const originalHtml = submitBtn.innerHTML;
                submitBtn.setAttribute('data-original-html', originalHtml);
                submitBtn.innerHTML = '<i class="flaticon-next"></i> <span style="margin-left: 5px;">Envoi...</span>';
                submitBtn.classList.add('loading');
            }

            // Préparer les données du formulaire
            const formData = new FormData();
            formData.append('email', emailInput.value.trim());
            formData.append('agreement', agreementCheckbox.checked ? '1' : '0');
            formData.append('_token', config.csrfToken);

            // Envoyer la requête AJAX
            fetch(`${config.baseUrl}/newsletter/subscribe`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Succès : afficher un message de confirmation
                    showNotification(notification, data.message || 'Votre inscription à la newsletter a été enregistrée avec succès !', 'success');
                    // Réinitialiser le formulaire
                    form.reset();
                } else {
                    // Erreur : afficher les messages d'erreur
                    if (data.errors) {
                        showErrors(data.errors, {
                            'email': '#error-nwsltr-email'
                        });
                        showNotification(notification, data.message || 'Veuillez corriger les erreurs.', 'error');
                    } else {
                        showNotification(notification, data.message || 'Une erreur est survenue. Veuillez réessayer.', 'error');
                    }
                }
            })
            .catch(error => {
                // Gérer les erreurs réseau
                console.error('Erreur:', error);
                showNotification(notification, 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer plus tard.', 'error');
            })
            .finally(() => {
                // Réactiver le bouton dans tous les cas
                if (submitBtn) {
                    submitBtn.disabled = false;
                    const originalHtml = submitBtn.getAttribute('data-original-html');
                    submitBtn.innerHTML = originalHtml || '<i class="flaticon-next"></i>';
                    submitBtn.classList.remove('loading');
                }
            });
        });
    }

    /**
     * =================================================================================
     * FORMULAIRE DE DON
     * =================================================================================
     */

    /**
     * Initialise et gère le formulaire de don
     */
    function initDonationForm() {
        const form = document.getElementById('donation-form');
        if (!form) return;

        // Récupération des éléments du DOM
        const submitBtn = document.getElementById('donation-submit-btn');
        const submitBtnAnonymous = document.getElementById('donation-submit-btn-anonymous');
        const btnText = document.getElementById('donation-btn-text');
        const btnTextAnonymous = document.getElementById('donation-btn-text-anonymous');
        const notification = document.getElementById('donation-notification');
        const amountInputs = document.querySelectorAll('input[name="donate-amount"]');
        const customAmountInput = document.getElementById('donate-amount-custom');
        const selectedAmountDisplay = document.getElementById('selected-amount-display');
        const donationTotalAmount = document.getElementById('donation-total-amount');
        const donationTotalAmountAnonymous = document.getElementById('donation-total-amount-anonymous');

        // Section des informations personnelles et bouton de soumission
        const personalInfoSection = document.getElementById('personal-info-section');
        const anonymousSubmitSection = document.getElementById('anonymous-submit-section');

        // Options Mobile Money (visible uniquement quand Mobile Money est sélectionné)
        const mobileMoneyOptions = document.getElementById('mobile-money-options');

        // Éléments pour le type de don (anonyme/non anonyme)
        const donationTypeInputs = document.querySelectorAll('input[name="donation_type"]');
        const paymentMethodInputs = document.querySelectorAll('input[name="payment_method"]');

        // Variable pour stocker le montant sélectionné
        let selectedAmount = 10;

        /**
         * Met à jour l'affichage du montant sélectionné
         */
        function updateSelectedAmount() {
            const selectedRadio = document.querySelector('input[name="donate-amount"]:checked');
            
            if (selectedRadio && selectedRadio.value !== 'custom') {
                // Montant prédéfini sélectionné
                selectedAmount = parseFloat(selectedRadio.value);
                if (selectedAmountDisplay) {
                    selectedAmountDisplay.textContent = selectedAmount.toFixed(2);
                }
                if (donationTotalAmount) {
                    donationTotalAmount.textContent = selectedAmount.toFixed(0);
                }
                if (donationTotalAmountAnonymous) {
                    donationTotalAmountAnonymous.textContent = selectedAmount.toFixed(0);
                }
                // Désactiver le champ montant personnalisé
                if (customAmountInput) {
                    customAmountInput.value = '';
                    customAmountInput.disabled = true;
                }
            } else if (selectedRadio && selectedRadio.value === 'custom') {
                // Montant personnalisé sélectionné
                if (customAmountInput) {
                    customAmountInput.disabled = false;
                    customAmountInput.focus();
                    if (customAmountInput.value) {
                        selectedAmount = parseFloat(customAmountInput.value) || 0;
                        if (selectedAmountDisplay) {
                            selectedAmountDisplay.textContent = selectedAmount.toFixed(2);
                        }
                        if (donationTotalAmount) {
                            donationTotalAmount.textContent = selectedAmount.toFixed(0);
                        }
                        if (donationTotalAmountAnonymous) {
                            donationTotalAmountAnonymous.textContent = selectedAmount.toFixed(0);
                        }
                    }
                }
            }
        }

        /**
         * Gère le changement du type de don (anonyme/non anonyme)
         */
        function handleDonationTypeChange() {
            const selectedType = document.querySelector('input[name="donation_type"]:checked');
            
            if (selectedType && selectedType.value === 'anonymous') {
                // Don anonyme : cacher les informations personnelles, afficher le bouton anonyme
                if (personalInfoSection) {
                    personalInfoSection.style.display = 'none';
                    // Retirer le required des champs pour permettre la soumission anonyme
                    const requiredFields = personalInfoSection.querySelectorAll('[required]');
                    requiredFields.forEach(field => {
                        field.removeAttribute('required');
                    });
                }
                if (anonymousSubmitSection) {
                    anonymousSubmitSection.style.display = 'block';
                }
            } else {
                // Don non anonyme : afficher les informations personnelles, cacher le bouton anonyme
                if (personalInfoSection) {
                    personalInfoSection.style.display = 'block';
                    // Remettre le required sur les champs
                    const fields = personalInfoSection.querySelectorAll('#first_name, #last_name, #donation-email');
                    fields.forEach(field => {
                        field.setAttribute('required', 'required');
                    });
                }
                if (anonymousSubmitSection) {
                    anonymousSubmitSection.style.display = 'none';
                }
            }
        }

        /**
         * Gère le changement de méthode de paiement
         */
        function handlePaymentMethodChange() {
            const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
            
            if (selectedMethod && selectedMethod.value === 'mobile_money') {
                // Afficher les options Mobile Money
                if (mobileMoneyOptions) {
                    mobileMoneyOptions.style.display = 'block';
                }
            } else {
                // Cacher les options Mobile Money
                if (mobileMoneyOptions) {
                    mobileMoneyOptions.style.display = 'none';
                }
            }
        }

        /**
         * Gère la soumission du formulaire de don
         */
        function handleFormSubmit(e) {
            e.preventDefault();

            // Calculer le montant final (au cas où c'est un montant personnalisé)
            if (document.getElementById('custom-amount') && document.getElementById('custom-amount').checked) {
                selectedAmount = parseFloat(customAmountInput.value) || 0;
            }

            // Validation : vérifier que le montant est valide
            if (selectedAmount <= 0) {
                showNotification(notification, 'Veuillez sélectionner un montant valide.', 'error');
                return;
            }

            // Déterminer quel bouton a été utilisé
            const isAnonymous = document.querySelector('input[name="donation_type"]:checked')?.value === 'anonymous';
            const activeSubmitBtn = isAnonymous ? submitBtnAnonymous : submitBtn;
            const activeBtnText = isAnonymous ? btnTextAnonymous : btnText;

            // Désactiver le bouton de soumission
            if (activeSubmitBtn) {
                activeSubmitBtn.disabled = true;
                if (activeBtnText) {
                    activeBtnText.textContent = 'Traitement en cours...';
                }
            }

            // Préparer les données du formulaire
            const formData = new FormData(form);
            formData.append('amount', selectedAmount.toFixed(2));
            
            // Ajouter le type de don
            const donationType = document.querySelector('input[name="donation_type"]:checked')?.value || 'non-anonymous';
            formData.append('donation_type', donationType);

            // Envoyer la requête AJAX
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Succès : afficher un message de confirmation
                    showNotification(notification, data.message, 'success');
                    // Réinitialiser le formulaire
                    form.reset();
                    selectedAmount = 10;
                    updateSelectedAmount();
                    // Réinitialiser l'affichage
                    handleDonationTypeChange();
                    handlePaymentMethodChange();
                    // Effacer les erreurs
                    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
                    document.querySelectorAll('input').forEach(el => el.classList.remove('error'));

                    // Faire défiler vers le haut après 2 secondes
                    setTimeout(() => {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }, 2000);
                } else {
                    // Erreur : afficher les messages d'erreur
                    if (data.errors) {
                        showErrors(data.errors, {
                            'first_name': '#error-first_name',
                            'last_name': '#error-last_name',
                            'email': '#error-email'
                        });
                        showNotification(notification, data.message || 'Veuillez corriger les erreurs dans le formulaire.', 'error');
                    } else {
                        showNotification(notification, data.message || 'Une erreur est survenue. Veuillez réessayer.', 'error');
                    }
                }
            })
            .catch(error => {
                // Gérer les erreurs réseau
                console.error('Erreur:', error);
                showNotification(notification, 'Une erreur est survenue lors du traitement de votre don. Veuillez réessayer plus tard.', 'error');
            })
            .finally(() => {
                // Réactiver le bouton dans tous les cas
                if (activeSubmitBtn) {
                    activeSubmitBtn.disabled = false;
                    if (activeBtnText) {
                        activeBtnText.textContent = 'Faire un don maintenant';
                    }
                }
            });
        }

        // Écouter les changements de montant
        amountInputs.forEach(input => {
            input.addEventListener('change', updateSelectedAmount);
        });

        // Écouter les changements du montant personnalisé
        if (customAmountInput) {
            customAmountInput.addEventListener('input', function() {
                if (document.getElementById('custom-amount') && document.getElementById('custom-amount').checked) {
                    selectedAmount = parseFloat(this.value) || 0;
                    if (selectedAmount > 0) {
                        if (selectedAmountDisplay) {
                            selectedAmountDisplay.textContent = selectedAmount.toFixed(2);
                        }
                        if (donationTotalAmount) {
                            donationTotalAmount.textContent = selectedAmount.toFixed(0);
                        }
                        if (donationTotalAmountAnonymous) {
                            donationTotalAmountAnonymous.textContent = selectedAmount.toFixed(0);
                        }
                    }
                }
            });
        }

        // Écouter les changements du type de don
        donationTypeInputs.forEach(input => {
            input.addEventListener('change', handleDonationTypeChange);
        });

        // Écouter les changements de méthode de paiement
        paymentMethodInputs.forEach(input => {
            input.addEventListener('change', handlePaymentMethodChange);
        });

        // Écouter la soumission du formulaire
        form.addEventListener('submit', handleFormSubmit);

        // Initialiser l'affichage au chargement
        updateSelectedAmount();
        handleDonationTypeChange();
        handlePaymentMethodChange();
    }

    /**
     * =================================================================================
     * RECHERCHE GLOBALE ASYNCHRONE
     * =================================================================================
     */

    /**
     * Initialise la recherche globale asynchrone
     */
    function initGlobalSearch() {
        const searchInput = document.getElementById('ul-search');
        const searchForm = document.getElementById('global-search-form');
        
        if (!searchInput || !searchForm) return;

        // Créer le conteneur de résultats s'il n'existe pas
        let searchResults = document.getElementById('search-results');
        if (!searchResults) {
            searchResults = document.createElement('div');
            searchResults.id = 'search-results';
            searchResults.className = 'search-results-dropdown';
            searchForm.appendChild(searchResults);
        }

        let searchTimeout = null;
        let currentQuery = '';
        let isSearchOpen = false;

        /**
         * Effectue la recherche asynchrone
         */
        async function performSearch(query) {
            currentQuery = query;

            if (query.length < 2) {
                showSearchHint();
                return;
            }

            // Afficher le loading
            showSearchLoading();

            try {
                const searchUrl = searchForm.dataset.searchUrl || '/api/search';
                const response = await fetch(`${searchUrl}?q=${encodeURIComponent(query)}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                if (!response.ok) {
                    throw new Error('Erreur réseau');
                }

                const data = await response.json();

                // Vérifier que la query est toujours la même (éviter les conditions de course)
                if (query === currentQuery && data.success) {
                    displaySearchResults(data.results, query);
                }
            } catch (error) {
                console.error('Erreur de recherche:', error);
                showSearchError();
            }
        }

        /**
         * Affiche l'indication de saisie
         */
        function showSearchHint() {
            searchResults.innerHTML = `
                <div class="search-hint">
                    <span class="search-hint-icon"><i class="flaticon-search"></i></span>
                    <p>Tapez au moins 2 caractères pour rechercher</p>
                </div>
            `;
            searchResults.classList.add('active');
            isSearchOpen = true;
        }

        /**
         * Affiche l'état de chargement
         */
        function showSearchLoading() {
            searchResults.innerHTML = `
                <div class="search-loading">
                    <div class="search-loading-spinner"></div>
                    <p>Recherche en cours...</p>
                </div>
            `;
            searchResults.classList.add('active');
            isSearchOpen = true;
        }

        /**
         * Affiche une erreur
         */
        function showSearchError() {
            searchResults.innerHTML = `
                <div class="search-no-results">
                    <span class="search-no-results-icon"><i class="flaticon-warning"></i></span>
                    <h5>Erreur de connexion</h5>
                    <p>Impossible d'effectuer la recherche. Veuillez réessayer.</p>
                </div>
            `;
        }

        /**
         * Affiche les résultats de recherche
         */
        function displaySearchResults(results, query) {
            if (!results || results.length === 0) {
                searchResults.innerHTML = `
                    <div class="search-no-results">
                        <span class="search-no-results-icon"><i class="flaticon-search"></i></span>
                        <h5>Aucun résultat trouvé</h5>
                        <p>Aucun résultat pour "<strong>${escapeHtml(query)}</strong>"</p>
                        <p style="margin-top: 8px; font-size: 13px;">Essayez avec d'autres termes de recherche.</p>
                    </div>
                `;
                return;
            }

            // Grouper les résultats par type
            const grouped = {
                article: results.filter(r => r.type === 'article'),
                event: results.filter(r => r.type === 'event'),
                team: results.filter(r => r.type === 'team')
            };

            let html = `
                <div class="search-results-header">
                    <h4><i class="flaticon-search" style="margin-right: 8px;"></i>Résultats de recherche</h4>
                    <span>${results.length} résultat${results.length > 1 ? 's' : ''}</span>
                </div>
            `;

            // Afficher les articles
            if (grouped.article.length > 0) {
                html += `<div class="search-group-title"><i class="flaticon-price-tag" style="margin-right: 6px;"></i>Articles (${grouped.article.length})</div>`;
                grouped.article.forEach(item => {
                    html += createSearchResultItem(item, query);
                });
            }

            // Afficher les événements
            if (grouped.event.length > 0) {
                html += `<div class="search-group-title"><i class="flaticon-calendar" style="margin-right: 6px;"></i>Événements (${grouped.event.length})</div>`;
                grouped.event.forEach(item => {
                    html += createSearchResultItem(item, query);
                });
            }

            // Afficher l'équipe
            if (grouped.team.length > 0) {
                html += `<div class="search-group-title"><i class="flaticon-team" style="margin-right: 6px;"></i>Équipe (${grouped.team.length})</div>`;
                grouped.team.forEach(item => {
                    html += createSearchResultItem(item, query);
                });
            }

            searchResults.innerHTML = html;
        }

        /**
         * Crée un élément de résultat HTML
         */
        function createSearchResultItem(item, query) {
            const title = highlightSearchText(item.title, query);
            const description = highlightSearchText(item.description || '', query);
            const fallbackImage = '/assets/img/blog-1.jpg';
            
            return `
                <a href="${item.url}" class="search-result-item" tabindex="0">
                    <img src="${item.image || fallbackImage}" alt="${escapeHtml(item.title)}" class="search-result-image" onerror="this.src='${fallbackImage}'">
                    <div class="search-result-content">
                        <h5 class="search-result-title">${title}</h5>
                        <p class="search-result-description">${description}</p>
                    </div>
                    <span class="search-result-type ${item.type}">${item.type_label}</span>
                </a>
            `;
        }

        /**
         * Met en surbrillance le texte recherché
         */
        function highlightSearchText(text, query) {
            if (!query || !text) return escapeHtml(text || '');
            const escaped = escapeHtml(text);
            const regex = new RegExp(`(${escapeRegex(query)})`, 'gi');
            return escaped.replace(regex, '<span class="search-highlight">$1</span>');
        }

        /**
         * Échappe les caractères HTML
         */
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        /**
         * Échappe les caractères regex
         */
        function escapeRegex(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }

        /**
         * Ferme les résultats de recherche
         */
        function closeSearchResults() {
            searchResults.classList.remove('active');
            isSearchOpen = false;
        }

        /**
         * Ouvre les résultats de recherche
         */
        function openSearchResults() {
            if (currentQuery.length >= 2) {
                searchResults.classList.add('active');
                isSearchOpen = true;
            } else if (searchInput.value.length > 0) {
                showSearchHint();
            }
        }

        // Événement de saisie avec debounce
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.trim();

            // Annuler le timeout précédent
            if (searchTimeout) {
                clearTimeout(searchTimeout);
            }

            if (query.length === 0) {
                closeSearchResults();
                return;
            }

            if (query.length < 2) {
                showSearchHint();
                return;
            }

            // Debounce de 300ms
            searchTimeout = setTimeout(() => {
                performSearch(query);
            }, 300);
        });

        // Empêcher la soumission du formulaire
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = searchInput.value.trim();
            if (query.length >= 2) {
                performSearch(query);
            }
        });

        // Focus sur le champ de recherche
        searchInput.addEventListener('focus', function() {
            if (this.value.length > 0) {
                openSearchResults();
            }
        });

        // Fermer les résultats quand on clique ailleurs
        document.addEventListener('click', function(e) {
            if (!searchForm.contains(e.target) && !searchResults.contains(e.target)) {
                closeSearchResults();
            }
        });

        // Navigation au clavier
        searchInput.addEventListener('keydown', function(e) {
            if (!isSearchOpen) return;

            const items = searchResults.querySelectorAll('.search-result-item');
            if (items.length === 0) return;

            const activeItem = searchResults.querySelector('.search-result-item:focus');
            let currentIndex = Array.from(items).indexOf(activeItem);

            switch (e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    if (currentIndex < items.length - 1) {
                        items[currentIndex + 1].focus();
                    } else {
                        items[0].focus();
                    }
                    break;

                case 'ArrowUp':
                    e.preventDefault();
                    if (currentIndex > 0) {
                        items[currentIndex - 1].focus();
                    } else if (currentIndex === 0) {
                        searchInput.focus();
                    } else {
                        items[items.length - 1].focus();
                    }
                    break;

                case 'Escape':
                    e.preventDefault();
                    closeSearchResults();
                    searchInput.blur();
                    break;

                case 'Enter':
                    if (activeItem) {
                        e.preventDefault();
                        window.location.href = activeItem.href;
                    }
                    break;
            }
        });

        // Navigation au clavier sur les éléments de résultat
        searchResults.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSearchResults();
                searchInput.focus();
            }
        });

        // Fermer les résultats quand on ferme le modal de recherche
        const searchCloser = document.querySelector('.ul-search-closer');
        if (searchCloser) {
            searchCloser.addEventListener('click', function() {
                closeSearchResults();
                searchInput.value = '';
                currentQuery = '';
            });
        }

        // Également écouter les clics en dehors pour fermer
        const searchWrapper = document.querySelector('.ul-search-form-wrapper');
        if (searchWrapper) {
            // Quand le wrapper perd la classe active (modal fermé)
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        if (!searchWrapper.classList.contains('active')) {
                            closeSearchResults();
                        }
                    }
                });
            });
            observer.observe(searchWrapper, { attributes: true });
        }
    }

    /**
     * =================================================================================
     * INITIALISATION
     * =================================================================================
     */

    // Initialiser tous les formulaires lorsque le DOM est prêt
    document.addEventListener('DOMContentLoaded', function() {
        initContactForm();
        initNewsletterForm();
        initDonationForm();
        initGlobalSearch();
    });

})();
