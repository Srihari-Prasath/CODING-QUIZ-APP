 <script>
        window.addEventListener('DOMContentLoaded', async () => {
            try {
                const res = await fetch('<?php echo $api; ?>helpers/sessionStatus.php', {
                    credentials: 'include'
                });
                const data = await res.json();

                if (!data.logged_in) {
                    window.location.href = '../';
                }
            } catch (err) {
                console.error("Session check failed", err);
            }
        });
    </script>