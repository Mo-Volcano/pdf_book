
    <?php
    include("layout\include\header.php");
    ?> 
<section class="contact-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            
            <!-- ✅ فورم التواصل -->
            <div class="col-md-7">
                <div class="card p-4 shadow-sm border-0">
                    <h3 class="text-center text-success mb-4">📩 تواصل معنا</h3>
                    <p class="text-center text-muted mb-4">
                        إذا كنت تبحث عن <span class="text-success fw-bold">بناء مواقع احترافية</span> 
                        باستخدام <span class="fw-bold">PHP</span> أو 
                        <span class="fw-bold">Laravel</span> أو حتى مواقع Frontend مميزة بـ 
                        <span class="fw-bold">Vue.js</span>، يمكنك التواصل معي عبر النموذج أدناه.
                    </p>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم الكامل</label>
                            <input type="text" class="form-control" id="name" placeholder="أدخل اسمك">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" placeholder="example@email.com">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">رسالتك</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="أدخل رسالتك هنا..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100 rounded-pill">إرسال الرسالة</button>
                    </form>
                </div>
            </div>

            <!-- ✅ معلومات التواصل -->
            <div class="col-md-4 mt-4 mt-md-0">
                <div class="card p-4 shadow-sm border-0 bg-light">
                    <h5 class="text-success mb-3">📍 معلومات التواصل</h5>
                    <p>يمكنك التواصل معي عبر البريد أو زيارة حساباتي:</p>
                    
                    <p><strong>📧 البريد:</strong><br>
                        <a href="mailto:your@email.com" 
                           class="text-success">your@email.com</a>
                    </p>

                    <p><strong>💼 معرض الأعمال:</strong><br>
                        <a href="https://mostaql.com/u/Mo_volcano/portfolio" target="_blank" class="text-success">
                            mostaql.com/u/Mo_volcano/portfolio
                        </a>
                    </p>

                    <p><strong>💻 GitHub:</strong><br>
                        <a href="https://github.com/Mo-Volcano" target="_blank" class="text-success">
                            github.com/Mo-Volcano
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>



    <!-- end book -->
    <!-- start footer -->
    <?php 
    include("layout\include\/footer.php");?>
  