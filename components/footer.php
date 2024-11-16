<?php

class footer
{
    function footercont()
    {
        ?>
            <footer>
                <div id="footer" class="section__container footer__container">
                <div class="footer__col">
                    <h4>Company</h4>
                    <ul class="footer__links">
                    <li><a href="/pages/signup.php">Join Us</a></li>
                    <li><a href="/pages/stock.php">Explore</a></li>
                    <li><a href="/pages/about.php#testimonials">Testimonials</a></li>
                    <li><a href="/pages/about.php#awards">Partners</a></li>
                    </ul>
                </div>
                <div class="footer__col">
                    <h4>About Ebuy</h4>
                    <ul class="footer__links">
                    <li><a href="/pages/about.php#services">Services</a></li>
                    <li><a href="/pages/about.php#story">Our Story</a></li>
                    <li><a href="/pages/about.php#unique">Why Ebuy</a></li>
                    </ul>
                </div>
                <div class="footer__col">
                    <h4>Resources</h4>
                    <ul class="footer__links">
                    <li><a href="/formclasses/assets/php/verifier.php">My account</a></li>
                    <li><a href="/wip/business.php
                    ">Events</a></li>
                    <li><a href="#">Developer</a></li>
                    </ul>
                </div>
                <div class="footer__col">
                    <h4>Legal</h4>
                    <ul class="footer__links">
                        <li style="font-weight: bold; color: var(--primary-color);" onclick="downloadPolicy('terms')">Terms of Service</li>
                        <li style="font-weight: bold; color: var(--primary-color);" onclick="downloadPolicy('data')">Data Policy</li>
                        <li style="font-weight: bold; color: var(--primary-color);" onclick="downloadPolicy('privacy')">Privacy Policy</li>
                    </ul>
                </div>
                </div>
                <div class="section__container footer__bar">
                <h4>Ebuy</h4>
                <p>Copyright © 2024 Ebuy. All rights reserved.</p>
                <ul class="footer__socials">
                    <li>
                    <a href="#"><i class="ri-facebook-fill"></i></a>
                    </li>
                    <li>
                    <a href="#"><i class="ri-twitter-fill"></i></a>
                    </li>
                    <li>
                    <a href="#"><i class="ri-instagram-fill"></i></a>
                    </li>
                    <li>
                    <a href="#"><i class="ri-whatsapp-fill"></i></a>
                    </li>
                    <li>
                    <a href="#"><i class="ri-youtube-fill"></i></a>
                    </li>
                </ul>
                </div>
            </footer>
            
            <!--Scripts-->
            <script src="https://unpkg.com/scrollreveal"></script>
            <script src="/main.js"></script>

            <!--Policy Download-->
            <script>
                function downloadPolicy(policy) {
                    window.open('/documents/' + policy + '.pdf', '_blank');
                }
            </script>
            </body>
            </html>
        <?php
    }
}
?>