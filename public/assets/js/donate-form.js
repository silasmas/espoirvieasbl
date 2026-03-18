/**
 * donate-form.js
 * Gestion du formulaire de don (page dédiée et modal spontané dans le layout).
 * Inclus sur toutes les pages via public.blade.php.
 */

document.addEventListener("DOMContentLoaded", function () {

    // =========================================================================
    // Formulaire de don sur la page dédiée (sélecteurs sans préfixe "spontaneous-")
    // =========================================================================
    const customInput = document.querySelector(".ul-donate-form-custom-input");
    const radioButtons = document.querySelectorAll('input[name="donate-amount"]');

    if (customInput && radioButtons.length) {
        const defaultSelected = document.querySelector('input[name="donate-amount"]:checked');
        if (defaultSelected && defaultSelected.id !== "donate-amount-custom") {
            customInput.value = defaultSelected.nextElementSibling.textContent.replace('$', '').replace('€', '').trim();
        }

        radioButtons.forEach(radio => {
            radio.addEventListener("change", () => {
                if (radio.id !== "custom-amount") {
                    customInput.value = radio.nextElementSibling.textContent.replace('$', '').replace('€', '').trim();
                }
            });
        });

        customInput.addEventListener("focus", () => {
            const selectedRadio = document.querySelector('input[name="donate-amount"]:checked');
            if (selectedRadio && selectedRadio.id !== "custom-amount") {
                selectedRadio.checked = true;
            }
        });
    }

    // =========================================================================
    // Modal de don spontané (header) : ouverture / fermeture
    // =========================================================================
    const donateBtn = document.getElementById("spontaneous-donation-btn");
    const modal = document.getElementById("spontaneous-donation-modal");
    const closeModalBtn = document.getElementById("spontaneous-donation-modal-close");

    function openSpontaneousModal() {
        if (!modal) return;
        modal.style.display = "flex";
        document.body.style.overflow = "hidden";
        void modal.offsetWidth;
        setTimeout(function () {
            modal.classList.add("show");
            window.updateCustomAmountPlaceholder && window.updateCustomAmountPlaceholder();
        }, 10);
    }

    function closeSpontaneousModal() {
        if (!modal) return;
        modal.classList.remove("show");
        setTimeout(function () {
            modal.style.display = "none";
            document.body.style.overflow = "";
        }, 300);
    }

    if (donateBtn && modal && closeModalBtn) {
        donateBtn.addEventListener("click", function (e) {
            e.preventDefault();
            openSpontaneousModal();
        });

        closeModalBtn.addEventListener("click", function (e) {
            e.preventDefault();
            closeSpontaneousModal();
        });

        modal.addEventListener("mousedown", function (e) {
            if (e.target === modal) {
                closeSpontaneousModal();
            }
        });

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape" && modal.classList.contains("show")) {
                closeSpontaneousModal();
            }
        });
    }

    // =========================================================================
    // Don spontané : type de don (anonyme / non anonyme) → masquer uniquement les 3 champs (prénom, nom, email).
    // Le titre "Informations personnelles", le bouton et le total du don restent toujours visibles.
    // =========================================================================
    const typeNonAnon = document.getElementById("spontaneous-donation-type-1");
    const typeAnon = document.getElementById("spontaneous-donation-type-2");
    const personalFieldsOnly = document.getElementById("spontaneous-personal-fields-only");

    function toggleAnonSection() {
        if (!typeAnon || !personalFieldsOnly) return;
        if (typeAnon.checked) {
            personalFieldsOnly.style.display = "none";
        } else {
            personalFieldsOnly.style.display = "";
        }
    }

    if (typeNonAnon && typeAnon) {
        typeNonAnon.addEventListener("change", toggleAnonSection);
        typeAnon.addEventListener("change", toggleAnonSection);
        toggleAnonSection();
    }

    // =========================================================================
    // Don spontané : montants dynamiques selon devise (USD: 10,20... / CDF: 1000, 10000...)
    // =========================================================================
    const currencyDisplay = document.querySelector("#spontaneous-donation-wrapper .selected-amount .currency");
    const amountDisplay = document.getElementById("spontaneous-selected-amount-display");
    const totalAmountEl = document.getElementById("spontaneous-donation-total-amount");

    function getCurrency() {
        const currencyRadio = document.querySelector("#spontaneous-donation-wrapper input[name='donation_currency']:checked");
        return currencyRadio ? currencyRadio.value : "USD";
    }

    function getSymbol() {
        return getCurrency() === "CDF" ? "FC" : "$";
    }

    function updateAmountLabels() {
        const currency = getCurrency();
        const symbol = getSymbol();
        const amount5Wrapper = document.querySelector("#spontaneous-donation-wrapper .spontaneous-amount-usd-only");
        const amount5Radio = document.getElementById("spontaneous-donate-amount-5");
        if (amount5Wrapper && amount5Radio) {
            if (currency === "CDF") {
                amount5Wrapper.style.display = "none";
                if (amount5Radio.checked) {
                    document.getElementById("spontaneous-donate-amount-4").checked = true;
                }
            } else {
                amount5Wrapper.style.display = "";
            }
        }
        const amountRadios = document.querySelectorAll("#spontaneous-donation-wrapper input[name='donate-amount']:not([id='spontaneous-custom-amount'])");
        amountRadios.forEach(function (radio) {
            const val = currency === "CDF" ? (radio.dataset.cdf || radio.value) : (radio.dataset.usd || radio.value);
            radio.value = val;
            const label = radio.nextElementSibling;
            if (label) label.textContent = parseInt(val, 10).toLocaleString("fr-FR") + " " + symbol;
        });
    }

    function updateSpontaneousMontant() {
        const current = document.querySelector("#spontaneous-donation-wrapper input[name='donate-amount']:checked");
        const currency = getCurrency();
        const defaultVal = currency === "CDF" ? 1000 : 10;
        let val = defaultVal;
        if (current) {
            if (current.value === "custom") {
                const customEl = document.getElementById("spontaneous-donate-amount-custom");
                const cval = customEl ? parseFloat(String(customEl.value).replace(",", ".").replace(/\s/g, "")) : NaN;
                val = isNaN(cval) || !cval ? defaultVal : parseFloat(cval);
            } else {
                val = parseFloat(current.value) || defaultVal;
            }
        }
        const symbol = getSymbol();

        var formatted = val >= 1000 ? val.toLocaleString("fr-FR") : val.toFixed(2);
        if (amountDisplay) amountDisplay.textContent = formatted;
        if (totalAmountEl) totalAmountEl.textContent = formatted;
        var totalAnon = document.getElementById("spontaneous-donation-total-amount-anonymous");
        if (totalAnon) totalAnon.textContent = formatted;
        if (currencyDisplay) currencyDisplay.textContent = symbol;
        document.querySelectorAll("#spontaneous-donation-wrapper .currency-total").forEach(function (el) {
            el.textContent = symbol;
        });
    }

    const spontaneousAmountRadios = document.querySelectorAll("#spontaneous-donation-wrapper input[name='donate-amount']");
    spontaneousAmountRadios.forEach(function (r) {
        r.addEventListener("change", updateSpontaneousMontant);
    });

    const spontaneousCurrencyRadios = document.querySelectorAll("#spontaneous-donation-wrapper input[name='donation_currency']");
    spontaneousCurrencyRadios.forEach(function (r) {
        r.addEventListener("change", function () {
            updateAmountLabels();
            updateSpontaneousMontant();
            updateCustomAmountPlaceholder();
        });
    });

    window.updateCustomAmountPlaceholder = function () {
        const customInput = document.getElementById("spontaneous-donate-amount-custom");
        if (!customInput) return;
        const currency = getCurrency();
        customInput.placeholder = currency === "CDF" ? "Ex: 15000" : "Ex: 25";
        customInput.step = currency === "CDF" ? "1" : "0.01";
    };

    const spontaneousCustomInput = document.getElementById("spontaneous-donate-amount-custom");
    if (spontaneousCustomInput) {
        spontaneousCustomInput.addEventListener("input", function () {
            const customRadio = document.getElementById("spontaneous-custom-amount");
            if (customRadio) customRadio.checked = true;
            updateSpontaneousMontant();
        });
        spontaneousCustomInput.addEventListener("focus", function () {
            const customRadio = document.getElementById("spontaneous-custom-amount");
            if (customRadio) customRadio.checked = true;
        });
    }

    updateAmountLabels();
    updateSpontaneousMontant();
    updateCustomAmountPlaceholder();

    // =========================================================================
    // Don spontané : méthode de paiement (Mobile Money vs Carte bancaire).
    // Le champ téléphone est maintenant DANS mmOptions, visible avec les opérateurs
    // même pour don anonyme (car Mobile Money nécessite toujours le numéro).
    // =========================================================================
    const methodMM = document.getElementById("spontaneous-method-1");
    const methodCard = document.getElementById("spontaneous-method-2");
    const mmOptions = document.getElementById("spontaneous-mobile-money-options");
    const phoneInput = document.getElementById("spontaneous_phone");

    function updateMMOptions() {
        if (methodMM && mmOptions) {
            mmOptions.style.display = methodMM.checked ? "block" : "none";
        }
        if (phoneInput) {
            if (methodMM && methodMM.checked) {
                phoneInput.setAttribute("required", "required");
            } else {
                phoneInput.removeAttribute("required");
            }
        }
    }

    if (methodMM && methodCard) {
        methodMM.addEventListener("change", updateMMOptions);
        methodCard.addEventListener("change", updateMMOptions);
        updateMMOptions();
    }

    // =========================================================================
    // Onglets Don spontané / Devenir donateur (dans le modal)
    // =========================================================================
    const donationTabs = document.querySelectorAll(".ul-donation-tab");
    const donationPanes = document.querySelectorAll(".ul-donation-tab-pane");

    donationTabs.forEach(tab => {
        tab.addEventListener("click", function () {
            const targetSelector = this.getAttribute("data-target");
            if (!targetSelector) return;

            donationTabs.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            donationPanes.forEach(pane => {
                if ("#" + pane.id === targetSelector) {
                    pane.style.display = "block";
                    pane.classList.add("active");
                } else {
                    pane.style.display = "none";
                    pane.classList.remove("active");
                }
            });
        });
    });

    // =========================================================================
    // Formulaire "Devenir donateur" : type de don (espèce / nature) → champs montant ou description
    // =========================================================================
    const donorTypeSelect = document.getElementById("donor-donation-type");
    const donorAmountGroup = document.getElementById("donor-amount-group");
    const donorNatureGroup = document.getElementById("donor-nature-group");

    function updateDonorTypeFields() {
        if (!donorTypeSelect || !donorAmountGroup || !donorNatureGroup) return;
        const value = donorTypeSelect.value;
        if (value === "espece") {
            donorAmountGroup.style.display = "block";
            donorNatureGroup.style.display = "none";
        } else if (value === "nature") {
            donorAmountGroup.style.display = "none";
            donorNatureGroup.style.display = "block";
        } else {
            donorAmountGroup.style.display = "none";
            donorNatureGroup.style.display = "none";
        }
    }

    if (donorTypeSelect) {
        donorTypeSelect.addEventListener("change", updateDonorTypeFields);
        updateDonorTypeFields();
    }
});
