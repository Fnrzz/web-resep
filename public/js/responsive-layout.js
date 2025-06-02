// public/js/responsive-layout.js
document.addEventListener('DOMContentLoaded', function() {
    // Tambahkan data-label untuk responsive table
    const headers = document.querySelectorAll('thead th');
    const cells = document.querySelectorAll('tbody td');
    
    headers.forEach((header, index) => {
        const label = header.textContent;
        document.querySelectorAll(`tbody td:nth-child(${index + 1})`).forEach(cell => {
            cell.setAttribute('data-label', label);
        });
    });
});