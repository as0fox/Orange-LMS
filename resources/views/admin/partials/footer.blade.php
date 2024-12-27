<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/js/boosted.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/js/fontawesome.min.js" crossorigin="anonymous"></script>
</script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const loaderContainer = document.querySelector('.loader-container');
            const mainContent = document.querySelector('.main-content');

            setTimeout(() => {
                loaderContainer.classList.add('fade-out');
                mainContent.style.display = 'block';
                
                setTimeout(() => {
                    loaderContainer.style.display = 'none';
                }, 500);
            }, 500);
        });
    </script>
</body>
</html>
