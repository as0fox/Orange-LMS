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