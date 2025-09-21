</main>
<footer class="bg-dark text-white text-center py-3 mt-auto">
    <p>&copy; <?php echo date('Y'); ?> Proyecto PHP 2025 Tecnologo Informatica.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const toasts = document.querySelectorAll('.toast.show');
    if (toasts.length > 0) {
        setTimeout(() => {
            toasts.forEach(toast => {
                const bsToast = new bootstrap.Toast(toast);
                bsToast.hide();
            });
        }, 3000);
    }
</script>

</body>

</html>