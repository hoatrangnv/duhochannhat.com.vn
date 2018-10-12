<?php
use \common\models\Contact;
use yii\helpers\Url;

?>
<script>
    !function ($forms) {
        [].forEach.call($forms, function ($form) {
            $form.onsubmit = function (event) {
                event.preventDefault();

                var $country = $form.querySelector('[name="country"]:checked');
                var $name = $form.querySelector('[name="name"]');
                var $phone = $form.querySelector('[name="phone"]');

                if (!$country) {
                    popup('Vui lòng chọn đất nước muốn du học');
                }

                else if (!($name && $name.value && $name.value.length > 0)) {
                    popup('Vui lòng nhập họ tên');
                }

                else if (!($phone && $phone.value && $phone.value.length > 0)) {
                    popup('Vui lòng nhập số điện thoại');
                }

                else if (!getIsValidPhone($phone.value)) {
                    popup('Số điện thoại không đúng định dạng');
                }

                else {
                    var fd = new FormData();
                    fd.append('title', '[Tư vấn] Du học ' + $country.value);
                    fd.append('customer_name', $name.value);
                    fd.append('customer_phone', $phone.value);
                    fd.append('type', <?= json_encode(Contact::TYPE__ADVISORY_REQUEST) ?>);

                    var xhr = new XMLHttpRequest();

                    $form.classList.add('loading-opacity');

                    xhr.addEventListener('load', function () {
                        var res = JSON.parse(xhr.responseText);
                        if (res === 'success') {
                            popup('<b>Gửi thành công!</b><br>Chúng tôi sẽ liên hệ với bạn sớm nhất theo số điện thoại: ' + $phone.value + '.');
                            $form.reset();
                        } else {
                            popup('Lỗi máy chủ: ' + xhr.responseText);
                        }
                        $form.classList.remove('loading-opacity');
                    });

                    xhr.addEventListener('error', function () {
                        popup('Gửi không thành công! Vui lòng kiểm tra kết nối mạng và thử lại.');
                        $form.classList.remove('loading-opacity');
                    });

                    xhr.open("POST", "<?= Url::to(['api/save-new-contact']) ?>");
                    xhr.send(fd);
                }
            };
        });
    }(document.querySelectorAll('form.contact-form'));

    function getIsValidPhone(value) {
        var flag = false;
        var phone = String(value);
        // phone = phone.replace('(+84)', '0');
        // phone = phone.replace('+84', '0');
        // phone = phone.replace('0084', '0');
        phone = phone.replace(/ /g, '');
        if (phone !== '') {
            var firstNumber = phone.substring(0, 2);

            if ((firstNumber === '09' || firstNumber === '08' || firstNumber === '03') && phone.length === 10) {
                if (phone.match(/^\d{10}/)) {
                    flag = true;
                }
            }

            else if (firstNumber === '01' && phone.length === 11) {
                if (phone.match(/^\d{11}/)) {
                    flag = true;
                }
            }
        }
        return flag;
    }
</script>