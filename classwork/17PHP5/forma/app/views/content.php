<main>
    <div class="container">
        <form id="contact" action="<?php $_PHP_SELF; ?>" method="post">
            <h3>Bendraukime</h3>
            <h4>Susisiekite su mumis šiandien!</h4>
            <p><input type="text" name="vardas" placeholder="Jūsų vardas" required autofocus></p>
            <p><input type="email" name="email" placeholder="Jūsų el. pašto adresas" required></p>
            <p><textarea placeholder="Jūsų žinutė..." name="message" required></textarea></p>
            <p><button name="submit" type="submit" id="contact-submit">Siųsti</button></p>
        </form>
    </div>
</main>
