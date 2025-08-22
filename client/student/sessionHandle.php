<script>
    lucide.createIcons();
    let name=document.querySelector('.name-text');
    let main_name=document.querySelector('.main-name');
    let role=document.querySelector('.role-text');
    
 window.addEventListener('DOMContentLoaded', async () => {
            try {
                const res = await fetch('<?php echo $api ?>helpers/student_session.php', 
                { credentials: 'include' });
                const data = await res.json(); 
              
          localStorage.setItem("user_id", data.id);
          localStorage.setItem("year", data.year);
          localStorage.setItem("department", data.id);
     
                if (!data.logged_in) {
                    
                    window.location.href = './';
                }
            } catch (err) {
                console.error('Session check failed', err);
            }
        });


    // handle logout
    async function handleLogout() {
      document.getElementById("logout-btn").addEventListener("click", async () => {
        try {
          const res = await fetch('<?php echo $api; ?>helpers/logout.php', {
            method: 'POST',
            credentials: 'include',
            headers: {
              'Content-Type': 'application/json'
            }
          });
          const data = await res.json();
        
          if (data.success) {
            localStorage.clear();
            alert("Logout successful!");
            window.location.href = "./";
          } else {
            alert("Logout failed!");
          }
        } catch (err) {
          alert("Logout error: " + err.message);
        }
      });
    }


    window.addEventListener('DOMContentLoaded', () => {
     
      handleLogout();

    });
  </script>