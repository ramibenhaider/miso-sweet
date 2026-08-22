@if (session('success') || session('error') || session('warning') || session('status') || $errors->any())
<style>
    .side-popup-container {
        position: fixed;
        top: 90px;
        right: 25px;
        z-index: 999999;
        display: flex;
        flex-direction: column;
        gap: 14px;
        width: 360px;
        max-width: calc(100vw - 40px);
        pointer-events: none;
        direction: rtl;
        font-family: 'Tajawal', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .side-popup-box {
        pointer-events: auto;
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 16px 18px;
        border-radius: 4px;
        color: #FFFFFF;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        animation: popupSlideInRight 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        transition: transform 0.35s ease, opacity 0.35s ease;
    }

    .side-popup-box.hide {
        animation: popupSlideOutRight 0.4s cubic-bezier(0.7, 0, 0.84, 0) forwards;
    }

    .side-popup-box.popup-success {
        background: #15803D;
        border-right: 6px solid #0E5227;
    }

    .side-popup-box.popup-error {
        background: #DC2626;
        border-right: 6px solid #991B1B;
    }

    .side-popup-box.popup-warning {
        background: #EA580C;
        border-right: 6px solid #9A3412;
    }

    .popup-icon-wrap {
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .popup-content {
        flex: 1;
    }

    .popup-title {
        font-size: 0.95rem;
        font-weight: 800;
        margin-bottom: 3px;
        display: block;
        letter-spacing: -0.2px;
    }

    .popup-text {
        font-size: 0.88rem;
        font-weight: 500;
        line-height: 1.45;
        word-break: break-word;
    }

    .popup-close-btn {
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.85);
        font-size: 1.4rem;
        cursor: pointer;
        padding: 0 2px;
        line-height: 1;
        transition: color 0.2s ease, transform 0.2s ease;
        flex-shrink: 0;
    }

    .popup-close-btn:hover {
        color: #FFFFFF;
        transform: scale(1.15);
    }

    .popup-timer-bar {
        position: absolute;
        bottom: 0;
        right: 0;
        height: 4px;
        background: rgba(255, 255, 255, 0.5);
        width: 100%;
        animation: popupTimer 6s linear forwards;
    }

    @keyframes popupSlideInRight {
        from {
            transform: translateX(120%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes popupSlideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(120%);
            opacity: 0;
        }
    }

    @keyframes popupTimer {
        from {
            width: 100%;
        }
        to {
            width: 0%;
        }
    }
</style>

<div class="side-popup-container" id="sidePopupContainer">
    @if (session('success') || session('status'))
        <div class="side-popup-box popup-success" role="alert">
            <div class="popup-icon-wrap">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="popup-content">
                <span class="popup-title">تمت العملية بنجاح</span>
                <div class="popup-text">{{ session('success') ?? session('status') }}</div>
            </div>
            <button type="button" class="popup-close-btn" aria-label="إغلاق">&times;</button>
            <div class="popup-timer-bar"></div>
        </div>
    @endif

    @if (session('error'))
        <div class="side-popup-box popup-error" role="alert">
            <div class="popup-icon-wrap">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <div class="popup-content">
                <span class="popup-title">حدث خطأ</span>
                <div class="popup-text">{{ session('error') }}</div>
            </div>
            <button type="button" class="popup-close-btn" aria-label="إغلاق">&times;</button>
            <div class="popup-timer-bar"></div>
        </div>
    @elseif ($errors->any())
        <div class="side-popup-box popup-error" role="alert">
            <div class="popup-icon-wrap">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="popup-content">
                <span class="popup-title">خطأ في الإدخال</span>
                <div class="popup-text">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
            <button type="button" class="popup-close-btn" aria-label="إغلاق">&times;</button>
            <div class="popup-timer-bar"></div>
        </div>
    @endif

    @if (session('warning'))
        <div class="side-popup-box popup-warning" role="alert">
            <div class="popup-icon-wrap">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="popup-content">
                <span class="popup-title">تنبيه</span>
                <div class="popup-text">{{ session('warning') }}</div>
            </div>
            <button type="button" class="popup-close-btn" aria-label="إغلاق">&times;</button>
            <div class="popup-timer-bar"></div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const popups = document.querySelectorAll('.side-popup-box');
        popups.forEach(function (popup) {
            let timer = setTimeout(function () {
                closeSidePopup(popup);
            }, 6000);

            const closeBtn = popup.querySelector('.popup-close-btn');
            if (closeBtn) {
                closeBtn.addEventListener('click', function () {
                    clearTimeout(timer);
                    closeSidePopup(popup);
                });
            }
        });

        function closeSidePopup(popup) {
            if (!popup || popup.classList.contains('hide')) return;
            popup.classList.add('hide');
            setTimeout(function () {
                if (popup.parentNode) {
                    popup.remove();
                }
            }, 400);
        }
    });
</script>
@endif
