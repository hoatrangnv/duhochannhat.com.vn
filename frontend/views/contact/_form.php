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
        <div class="field-title">Bạn muốn du học ở nước nào?</div>
        <div class="radio-group clr">
            <label>
                <input type="radio" name="country" value="japan">
                <span>Nhật Bản</span>
            </label>
            <label>
                <input type="radio" name="country" value="korea">
                <span>Hàn Quốc</span>
            </label>
        </div>
    </div>
    <div class="form-group">
        <input type="text" name="name" placeholder="Họ tên">
    </div>
    <div class="form-group">
        <input type="text" name="phone" placeholder="Số điện thoại">
    </div>
    <div class="form-group">
        <button type="submit" class="submit-button">Gửi</button>
    </div>
</form>
