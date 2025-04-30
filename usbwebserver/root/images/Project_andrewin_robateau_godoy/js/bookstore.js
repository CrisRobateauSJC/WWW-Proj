document.addEventListener("DOMContentLoaded", () => {
    // ... (search form validation)
  
    const removeButtons = document.querySelectorAll(".remove-button");
  
    removeButtons.forEach((button) => {
      button.addEventListener("click", (e) => {
        if (!confirm("Are you sure you want to remove this item from the cart?")) {
          e.preventDefault();
        }
      });
    });
  });