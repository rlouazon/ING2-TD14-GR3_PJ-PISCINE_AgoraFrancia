</div>
<script>
        $(document).ready(function() {
            function positionFooter() {
                var lastElement = $('.contenu').children().last();
                console.log("Last element:", lastElement[0]); // Affiche l'élément lui-même ou undefined
                
                if (lastElement.length > 0) {
                    var lastElementOffset = lastElement.offset();
                    var lastElementHeight = lastElement.outerHeight();
                    var footerHeight = $('.footer').outerHeight();
                    var windowHeight = $(window).height();
                    var dif=windowHeight-60;

                    console.log("lastElementHeight:", lastElementHeight); // Affiche la hauteur de l'éléments
                    console.log("lastElementOffset top:", lastElementOffset.top); // Affiche la coordonnée top
                    console.log("lastElementOffset left:", lastElementOffset.left); // Affiche la coordonnée left
                    console.log("windowHeight:", windowHeight); // Affiche la hauteur de la fenêtre

                    if (lastElementOffset) {
                        var footerTop = lastElementOffset.top  + 20;
                        console.log("footerTop:", footerTop); // Log avec la valeur de footerTop

                        if (footerTop + footerHeight < windowHeight) {
                            $('.footer').css({
                                position: 'absolute',
                                bottom: '0px'
                            });
                        } else {
                            $('.footer').css({
                                position: 'static',
                                'margin-top': 40+'px'
                            });
                        }
                    } else {
                        console.log("lastElementOffset is undefined.");
                    }
                } else {
                    console.log("No elements found in .content.");
                    $('.footer').css({
                                position: 'absolute',
                                bottom: '0px'
                    });
                }
            }

            positionFooter();
            $(window).resize(positionFooter);
        });
    </script>
<footer class="footer text-white">
    <div class="footer2 text-center ">
    <h2>AGORIA  FRANCIA</h2>
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

