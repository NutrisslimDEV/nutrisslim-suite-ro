alert('!');
document.addEventListener("DOMContentLoaded", function() {
    alert('1');
    if (window.location.href.includes('/site-editor/templates/product-archive')) {
        alert('2');
        // Hide all iframe previews
        var iframes = document.querySelectorAll('iframe');
        iframes.forEach(function(iframe) {
            iframe.style.display = 'none';
        });

        // Hide preview containers
        var previewContainers = document.querySelectorAll('.elementor-template-library-template');
        previewContainers.forEach(function(container) {
            container.style.display = 'none';
        });

        // Optionally, display a message to inform the user
        var message = document.createElement('div');
        message.style.textAlign = 'center';
        message.style.margin = '20px 0';
        message.innerHTML = '<p>Preview is disabled for this template to prevent server crashes.</p>';
        document.body.insertBefore(message, document.body.firstChild);
    }
});