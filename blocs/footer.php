<div class="footer">
    <h2>AGORIA  FRANCIA</h2>
    <p>Mail : contact@agorafrancia.fr | Tel. : +33600000000 | Addr. : 00 rue du petit pont, Paris 75015, France</p>
</div>
<script>
        function checkFooterVisibility() {
            var footer = document.querySelector('.footer');
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                footer.style.display = 'flex';
            } else {
                footer.style.display = 'none';
            }
        }

        window.addEventListener('scroll', checkFooterVisibility);
        window.addEventListener('resize', checkFooterVisibility);
        document.addEventListener('DOMContentLoaded', function() {
            checkFooterVisibility();
            if (document.body.offsetHeight <= window.innerHeight) {
                document.querySelector('.footer').style.display = 'flex';
            }
        });
    </script>

</body>

<?php 

if(isset($alert)){
    echo "<script>alert(\"".$alert."\");</script>";
}

?>

</html>