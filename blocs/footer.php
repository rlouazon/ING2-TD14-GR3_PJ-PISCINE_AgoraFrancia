</div>

<footer class="footer text-white">
    <div class="footer2 text-center ">
    <h2 style="margin-bottom: 0px">AGORA  FRANCIA</h2>
    <p>Mail : contact@agorafrancia.fr | Tel. : +33600000000 | Addr. : 00 rue du petit pont, Paris 75015, France</p>
    </div>
</footer>

<script>

        function positionFooter() {
            // Get footer element
            var footer = $('.footer');
            var contenu = $('.contenu');

            

            // Position footer absolutely at bottom
            contenu.css({
                marginBottom: 50 +"px",
                minHeight: window.innerHeight - 50 - 250 - footer.outerHeight()+"px"
            });

        }

        $(window).resize(function(e) {
            positionFooter();
        });
        $(document).ready(function() {
            positionFooter();
        });
</script>

    </body>
</html>
<?php 
if(isset($alert)){
    echo "<script>alert(\"".$alert."\");</script>";
}
?>

