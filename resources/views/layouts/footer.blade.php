<!-- footer -->
  <footer class="footer-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @guest
                    @if(Route::is('home'))
                    <!-- Disclaimer Section -->
                    <div class="disclaimer-section">
                        <p class="disclaimer-text">
                            <strong>Disclaimer:</strong> MLNO’Smart is an online marketplace acting solely as an intermediary platform for listers to showcase their products. All listings, including pricing and descriptions, are provided by third-party listers at their own discretion. MNLOsmart does not verify the authenticity, quality, or legality of listed items and makes no warranties or guarantees. Users are advised to exercise caution, verify details independently, and make purchases at their own risk. MNLOsmart is not responsible for any disputes, losses, or damages arising from transactions between users and listers.
                        </p>
                    </div>
                    
                    <!-- Divider -->
                    <div class="divider"></div>
                    @endif
                    @endguest
                    
                    <!-- Footer Navigation Links -->
                    <div class="footer-links text-center">
                        <a href="https://mlno.in/trading/" target="_blank">About us</a>
                        <a href="/image/MLNO'Smart-User-Guide.pdf" target="_blank">How it works</a>
                        <a href="/image/Terms-and-Conditions.pdf" target="_blank">Terms & Conditions</a>
                        <a href="/help-and-support">Help & Support</a>
                    </div>
                    
                    <!-- Copyright -->
                    <div class="text-center">
                        <p class="copyright-text mb-0">
                            Copyrights@MLNO. All rights reserved
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script>
  document.addEventListener('DOMContentLoaded', function () {
    const headers = document.querySelectorAll('.Search-Filter-section-header');

    headers.forEach(header => {
      header.addEventListener('click', function () {
        const targetSelector = header.getAttribute('data-target');
        const content = document.querySelector(targetSelector);

        if (content.style.display === 'none' || content.style.display === '') {
          content.style.display = 'block';
        } else {
          content.style.display = 'none';
        }
      });
    });
  });
</script>
</body>
</html>