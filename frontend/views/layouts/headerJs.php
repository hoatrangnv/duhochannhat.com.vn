<?php
/**
 * @var $this \yii\web\View
 */
use common\models\SiteParam;
use common\models\UrlParam;
use yii\helpers\Url;
?>
<script>
    // Init sliders
    // [].forEach.call(document.querySelectorAll(".slider"), initSlider);

    /**
     *
     * @param {HTMLElement} container
     * @param {HTMLElement} button
     * @param {string} viewId
     * @param {object} jsonParams
     * @param {int} page
     * @param {function|undefined} onSuccess
     * @param {function|undefined} onError
     */
    function loadMoreArticles(container, button, viewId, jsonParams, page, onSuccess, onError) {
        button.disabled = true;
        button.classList.add("loading");

        var xhttp = new XMLHttpRequest();

        xhttp.onload = function () {
            var data = JSON.parse(xhttp.responseText);
            container.innerHTML += data.content;
            if (!data.hasMore) {
                button.parentNode.removeChild(button);
            }
            if ("function" === typeof onSuccess) {
                onSuccess();
            }
        };
        xhttp.onloadend = function () {
            button.disabled = false;
            button.classList.remove("loading");
        };
        xhttp.onerror = function () {
            if ("function" === typeof onError) {
                onError();
            }
        };

        xhttp.open("POST", "<?= Url::to(['article/ajax-get-items'], true) ?>");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("<?=
            Yii::$app->request->csrfParam . '=' . Yii::$app->request->csrfToken
            . '&' . UrlParam::VIEW_ID . '=" + viewId + "'
            . '&' . UrlParam::JSON_PARAMS . '=" + JSON.stringify(jsonParams) + "'
            . '&' . UrlParam::PAGE . '=" + page + "'
            ?>");
    }

    /**
     *
     * @param {int} id
     * @param {string} field
     * @param {int} value
     */
    function updateArticleCounter(id, field, value) {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "<?= Url::to(['article/ajax-update-counter']) ?>");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("<?=
            Yii::$app->request->csrfParam . '=' . Yii::$app->request->csrfToken
            . '&' . UrlParam::FIELD . '=" + field + "'
            . '&' . UrlParam::VALUE . '=" + value + "'
            . '&' . UrlParam::ID . '=" + id + "'
        ?>");
    }

    /**
     * Determine the mobile operating system.
     * This function returns one of 'iOS', 'Android', 'Windows Phone', or 'unknown'.
     *
     * @returns {String}
     */
    function getMobileOperatingSystem() {
        var userAgent = navigator.userAgent || navigator.vendor || window.opera;

        // Windows Phone must come first because its UA also contains "Android"
        if (/windows phone/i.test(userAgent)) {
            return "Windows Phone";
        }

        if (/android/i.test(userAgent)) {
            return "Android";
        }

        // iOS detection from: http://stackoverflow.com/a/9039885/177710
        if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
            return "iOS";
        }

        return "unknown";
    }
</script>

<script>
    /**
     *
     * @param {Node|string} content
     * @param {object?} options
     */
    function popup(content, options) {
        options = options || {};

        var html = document.querySelector('html');

        var closeBtn = elm(
            "button",
            {
                html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" fill="#ccc" style="display: block">'
                + '<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>'
                + '</svg>'
            },
            {
                'class': 'popup-close-button',
                type: "button",
                style: style({
                    color: "white",
                    position: "absolute",
                    top: '5px',
                    right: '5px',
                    border: "none",
                    boxShadow: "none",
                    zIndex: 9999,
                    display: "block",
                    fontSize: "2rem"
                }),
                title: 'Đóng'
            }
        );

        var image = content instanceof HTMLElement ? content : elm(
            'div',
            {
                html: content
            },
            {
                style: style({
                    padding: "3rem",
                    background: "#FFF",
                    maxWidth: "95vw",
                    maxHeight: "95vh"
                })
            }
        );

        var container = elm(
            "div",
            elm(
                "div",
                [image, closeBtn],
                {
                    'class': 'popup-overlay',
                    style: style({
                        display: "block"
                    })
                }
            ),
            {
                'class': options.className ? 'popup ' + options.className : 'popup',
                style: style({
                    position: "fixed",
                    top: 0,
                    left: 0,
                    bottom: 0,
                    right: 0,
                    display: "flex",
                    flexDirection: "column",
                    alignItems: "center",
                    justifyContent: "center",
                    zIndex: 9999,
                    backgroundColor: "rgba(0, 0, 0, 0.75)",
                    overflowY: "auto",
                    "-webkit-overflow-scrolling": "touch"
                }),
                open: function () {
                    html && html.classList.add('has-popup');
                    container.parentNode || document.body.appendChild(container);
                },
                close: function () {
                    html && html.classList.remove('has-popup');
                    container.parentNode && container.parentNode.removeChild(container);
                }
            }
        );

        document.addEventListener("click", function (event) {
            container.contains(event.target)
            && image !== event.target
            && !image.contains(event.target)
            && container.close();
        });

        closeBtn.addEventListener("click", container.close);

        container.open();

        return container;
    }

    /**
     * creates an element with certain content and attributes
     *
     * @param {string} elementName
     * @param {string|Number|Node|Node[]|undefined ?} content
     * @param {object|undefined ?} attributes
     * @return {Element}
     */
    function elm(elementName, content, attributes) {
        var element = document.createElement(elementName);
        appendChildren(element, content);
        setAttributes(element, attributes);
        return element;
    }

    /**
     * appends children into a node
     *
     * @param {HTMLElement} element
     * @param {string|Node|Node[]} content
     */
    function appendChildren(element, content) {
        var append = function (t) {
            if (/string|number/.test(typeof t)) {
                var textNode = document.createTextNode(t);
                element.appendChild(textNode);
            } else if (t instanceof Node) {
                element.appendChild(t);
            } else if (t && t.html) {
                element.innerHTML += t.html;
            }
        };
        if (content instanceof Array) {
            content.forEach(function (item) {
                append(item);
            });
        } else {
            append(content);
        }
    }

    /**
     * sets attributes for a node
     *
     * @param {HTMLElement} element
     * @param {object} attributes
     */
    function setAttributes(element, attributes) {
        if (attributes) {
            var attrName;
            for (attrName in attributes) {
                if (attributes.hasOwnProperty(attrName)) {
                    var attrValue = attributes[attrName];
                    switch (typeof attrValue) {
                        case "string":
                        case "number":
                            element.setAttribute(attrName, attrValue);
                            break;
                        case "function":
                        case "boolean":
                            element[attrName] = attrValue;
                            break;
                        default:
                    }
                }
            }
        }
    }

    function empty(element) {
        while (element.firstChild) {
            element.removeChild(element.firstChild);
        }
    }

    /**
     *
     * @param {string} str
     * @return {string}
     */
    function camelCaseToDash(str) {
        return str.replace( /([a-z])([A-Z])/g, '$1-$2' ).toLowerCase();
    }

    /**
     *
     * @param {object} obj
     * @return {string}
     */
    function style(obj) {
        var result_array = [];
        var attrName;
        for (attrName in obj) {
            if (obj.hasOwnProperty(attrName)) {
                result_array.push(camelCaseToDash(attrName) + ": " + obj[attrName]);
            }
        }
        return result_array.join("; ");
    }
</script>