</div>

    <script>

        function positionFooter() {
            // Get footer element
            var footer = $('.footer');

            if (footer.length > 0) {
                // Get footer height
                var footerHeight = footer.outerHeight();
                $('body').css('min-height', window.innerHeight - footerHeight + 'px');

                if($('body').outerHeight() <= window.innerHeight){
                    $('body').css('height', window.innerHeight - footerHeight + 'px');
                }

                // Position footer absolutely at bottom
                footer.css({
                    position: 'absolute',
                    //top: (document.body.getBoundingClientRect().y + document.body.getBoundingClientRect().height).toString + ('px')
                    top: document.body.getBoundingClientRect().y + document.body.getBoundingClientRect().height + ('px')
                });
            } else {
            console.log("No elements found with class .footer");
            }
        }

        $(window).resize(function(e) {
            //positionFooter();
        });
        $(document).ready(function() {
            //positionFooter();
        });
    </script>

<footer class="footer text-white">
    <div class="footer2 text-center ">
    <h2 style="margin-bottom: 0px">AGORIA  FRANCIA</h2>
    <p>Mail : contact@agorafrancia.fr | Tel. : +33600000000 | Addr. : 00 rue du petit pont, Paris 75015, France</p>
    </div>
</footer>



    </body>
</html>
<?php 
if(isset($alert)){
    echo "<script>alert(\"".$alert."\");</script>";
}
?>

