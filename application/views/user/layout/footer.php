        </div><!-- end content-wrapper -->
    </div><!-- end main-content -->

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Animate cards on load
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.card, .stat-card, .bootcamp-card').forEach(function(card, index) {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(function() {
                    card.style.transition = 'all 0.4s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 50);
            });
        });
    </script>
</body>
</html>
