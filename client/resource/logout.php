<script>
    
 lucide.createIcons();
document.getElementById("logout-btn").addEventListener("click", async () => {
    try {
        const res = await fetch("<?php echo $api; ?>helpers/logout.php", {
            method: "POST",
            credentials: "include", 
            headers: {
                "Content-Type": "application/json",
            },
        });

        const data = await res.json();
        if (res.ok) {
            alert("Logout successful!");
            window.location.href = "../";
        } else {
            alert("Logout failed: " + data.error);
        }
    } catch (err) {
        alert("Logout error: " + err.message);
    }
});

</script>