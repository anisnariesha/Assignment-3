function openModal(card) {
    var modal = document.getElementById("serviceModal");
    var modalContent = document.getElementById("modalContent");

    // Extract data attributes from the clicked card
    var serviceName = card.getAttribute('data-service-name');
    var serviceDescription = card.getAttribute('data-service-description');
    var servicePrice = parseFloat(card.getAttribute('data-service-price'));
    var serviceImage = card.getAttribute('data-service-image');

    // Format price as RM
    var formattedPrice = servicePrice.toLocaleString('en-MY', { style: 'currency', currency: 'MYR' });

    // Populate modal content with the extracted data
    modalContent.innerHTML = `
        <div class="modal-body">
            <h1 style="margin-bottom: 10px; font-weight: bold">${serviceName}</h1>
            <img src="${serviceImage}" alt="${serviceName}" style="margin-bottom: 10px;">
            <p style="margin-bottom: 10px;">${serviceDescription}</p>
            <p style="margin-bottom: 10px;"><strong>Price: </strong>${formattedPrice}</p>
        </div>
    `;

    // Display the modal
    modal.style.display = "flex"; // Use flex to center vertically and horizontally

    // Handle modal close
    var closeModal = function() {
        modal.style.display = "none";
        closeBtn.removeEventListener("click", closeModal);
        window.removeEventListener("click", outsideClick);
        document.removeEventListener("keydown", escapeClose);
    };

    // Close modal when clicking on the close button inside modal footer
    var closeBtn = modal.querySelector(".modal-close-btn");
    closeBtn.addEventListener("click", closeModal);

    // Close modal when clicking outside of it
    var outsideClick = function(event) {
        if (event.target === modal) {
            closeModal();
        }
    };
    window.addEventListener("click", outsideClick);

    // Close modal with Escape key
    var escapeClose = function(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    };
    document.addEventListener("keydown", escapeClose);
}
