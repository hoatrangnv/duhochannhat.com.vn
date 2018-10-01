<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/21/2018
 * Time: 10:06 PM
 */
?>
<form class="contact-form">
    <div class="form-group">
        <?php
        if (isset($country) && in_array($country, ['Nhật Bản', 'Hàn Quốc'])) {
            ?>
            <div class="field-title text-center">Đăng ký tư vấn du học <?= $country ?></div>
            <div class="radio-group hidden">
                <label>
                    <input type="radio" name="country" value="Nhật Bản" <?= $country === 'Nhật Bản' ? 'checked' : '' ?>>
                    <span>Nhật Bản</span>
                </label>
                <label>
                    <input type="radio" name="country" value="Hàn Quốc" <?= $country === 'Hàn Quốc' ? 'checked' : '' ?>>
                    <span>Hàn Quốc</span>
                </label>
            </div>
            <?php
        } else {
            ?>
            <div class="field-title">Bạn muốn du học ở nước nào?</div>
            <div class="radio-group clr">
                <label>
                    <input type="radio" name="country" value="Nhật Bản">
                    <span>Nhật Bản</span>
                </label>
                <label>
                    <input type="radio" name="country" value="Hàn Quốc">
                    <span>Hàn Quốc</span>
                </label>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="form-group">
        <input type="text" name="name" placeholder="Họ tên">
    </div>
    <div class="form-group">
        <input type="tel" name="phone" placeholder="Số điện thoại">
    </div>
    <div class="form-group">
        <button type="submit" class="submit-button">Gửi</button>
    </div>
</form>
