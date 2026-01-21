/**
 * Gestionnaire de formulaires asynchrones
 * Gère les soumissions AJAX pour les formulaires de contact et newsletter
 */

(function() {
    'use strict';

    // Configuration
    const config = {
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        baseUrl: window.location.origin,
    };

    /**
     * Affiche une notification
     * @param {HTMLElement} container - Conteneur de la notification
     * @param {string} message - Message à afficher
     * @param {string} type - Type de notification (success, error, info)
     * @param {number} duration - Durée d'affichage en ms
     */
    function showNotification(container, message, type = 'success', duration = 5000) {
        if (!container) return;

        container.textContent = message;
        container.className = `async-notification ${type}`;
        container.style.display = 'block';

        // Faire défiler vers la notification
        container.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

        // Cacher la notification après la durée spécifiée
        if (duration > 0) {
            setTimeout(() => {
                container.style.display = 'none';
            }, duration);
        }
    }

    /**
     * Affiche les erreurs de validation
     * @param {Object} errors - Objet contenant les erreurs
     * @param {Object} fieldMap - Mapping des noms de champs vers les IDs des éléments
     */
    function showErrors(errors, fieldMap) {
        // Effacer les erreurs précédentes
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        document.querySelectorAll('input, textarea').forEach(el => el.classList.remove('error'));

        // Afficher les nouvelles erreurs
        Object.keys(errors).forEach(field => {
            const errorElement = document.querySelector(fieldMap[field] || `#error-${field}`);
            const inputElement = document.querySelector(`[name="${field}"]`);

            if (errorElement) {
                errorElement.textContent = errors[field][0];
            }

            if (inputElement) {
                inputElement.classList.add('error');
            }
        });
    }

    /**
     * Gère la soumission du formulaire de contact
     */
    function initContactForm() {
        const form = document.getElementById('contact-form');
        if (!form) return;

        const submitBtn = document.getElementById('contact-submit-btn');
        const btnText = document.getElementById('btn-text');
        const notification = document.getElementById('contact-notification');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Désactiver le bouton
            if (submitBtn) {
                submitBtn.disabled = true;
                if (btnText) btnText.textContent = 'Envoi en cours...';
            }

            const formData = new FormData(form);
            formData.append('_token', config.csrfToken);

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
                    showNotification(notification, data.message, 'success');
                    form.reset();
                    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
                    document.querySelectorAll('input, textarea').forEach(el => el.classList.remove('error'));
                } else {
                    if (data.errors) {
                        showErrors(data.errors, {
                            'name': '#error-name',
                            'email': '#error-email',
                            'subject': '#error-subject',
                            'message': '#error-message'
                        });
                        showNotification(notification, data.message || 'Veuillez corriger les erreurs dans le formulaire.', 'error');
                    } else {
                        showNotification(notification, data.message || 'Une erreur est survenue. Veuillez réessayer.', 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showNotification(notification, 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer plus tard.', 'error');
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    if (btnText) btnText.textContent = 'Envoyer le message';
                }
            });
        });
    }

    /**
     * Gère la soumission du formulaire de newsletter
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
            notification.className = 'newsletter-notification';
            notification.style.display = 'none';
            form.insertBefore(notification, form.firstChild);
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Vérifier que la case de confidentialité est cochée
            if (!agreementCheckbox.checked) {
                showNotification(notification, 'Veuillez accepter la politique de confidentialité pour vous abonner.', 'error');
                return;
            }

            // Vérifier que l'email est rempli
            if (!emailInput.value.trim()) {
                showNotification(notification, 'Veuillez entrer votre adresse email.', 'error');
                return;
            }

            // Désactiver le bouton
            if (submitBtn) {
                submitBtn.disabled = true;
                const originalHtml = submitBtn.innerHTML;
                submitBtn.setAttribute('data-original-html', originalHtml);
                submitBtn.innerHTML = '<i class="flaticon-next"></i> <span style="margin-left: 5px;">Envoi...</span>';
                submitBtn.classList.add('loading');
            }

            const formData = new FormData();
            formData.append('email', emailInput.value.trim());
            formData.append('agreement', agreementCheckbox.checked ? '1' : '0');
            formData.append('_token', config.csrfToken);

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
                    showNotification(notification, data.message || 'Votre inscription à la newsletter a été enregistrée avec succès !', 'success');
                    form.reset();
                } else {
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
                console.error('Erreur:', error);
                showNotification(notification, 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer plus tard.', 'error');
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    const originalHtml = submitBtn.getAttribute('data-original-html');
                    submitBtn.innerHTML = originalHtml || '<i class="flaticon-next"></i>';
                    submitBtn.classList.remove('loading');
                }
            });
        });
    }

    // Initialisation lorsque le DOM est prêt
    document.addEventListener('DOMContentLoaded', function() {
        initContactForm();
        initNewsletterForm();
    });

})();
