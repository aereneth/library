    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.modal').modal();
            $('select').formSelect();
            $('.carousel').carousel({
                dist: 0,
                shift: 50,
                padding: 20,
            });
            $('.slider').slider({
                indicators: false,
            });
        });

        $('.dropdown-trigger').dropdown({
            coverTrigger: false
        });
    </script>
</body>
</html>