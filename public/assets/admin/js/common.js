$(document).ready(function() {
document.querySelectorAll('.action_delete').forEach(function(element) {
    element.addEventListener('mouseenter', function() {
        this.querySelector('i').classList.remove('bi-trash3');
        this.querySelector('i').classList.add('bi-trash3-fill');
    });

    element.addEventListener('mouseleave', function() {
        this.querySelector('i').classList.remove('bi-trash3-fill');
        this.querySelector('i').classList.add('bi-trash3');
    });
});
});