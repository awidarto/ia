<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <script>
        function subst() {
            var vars={};
            var x=document.location.search.substring(1).split('&');
            for (var i in x) {var z=x[i].split('=',2);vars[z[0]] = unescape(z[1]);}
            var x=['frompage','topage','page','webpage','section','subsection','subsubsection'];
            for (var i in x) {
                var y = document.getElementsByClassName(x[i]);
                for (var j=0; j<y.length; ++j) y[j].textContent = vars[x[i]];
            }
        }
    </script>
</head>
<body>
    <div style="display:block;text-align:center;">
        <p class="muted credit">Copyright &copy; 2013 - Investors Alliance USA Property | Terms & Conditions | Privacy Policy</p>
        <p class="disclaimer" style="text-align:justify;display:block;width:100%;background-color:black;">
            <strong>DISCLAIMER:</strong> While every effort is made to ensure that this information is accurate and conforms with all applicable legal requirements it is supplied in good faith as an aid to users. Investors Alliance do not warrant that it is complete, comprehensive or accurate, or commit to its being updated. In no event shall Investors Alliance be liable for any incidental, indirect, consequential or special damages of any kind, or any damages whatsoever, including, without limitation, those resulting from loss of profit, loss of contracts, goodwill, data, information, income, expected savings or business relationships, whether or not advised of the possibility of such damage, arising out of or in connection with the use of this information.
        </p>
        <p class="disclaimer">
            Copyright - All materials contained herein are, unless otherwise stated, the property of Investors Alliance. Reproduction or retransmission of the materials, in whole or in part, in any manner, without the prior written consent of the copyright holder, is a violation of copyright law.
        </p>
        <img src="{{ URL::to('images/ia_print_footer.png')}}" alt="footer image" />
    </div></body>
</html>