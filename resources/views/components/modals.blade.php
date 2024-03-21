@if($modalType == 'success')
    <div class="modal1 d-none" id="success-modal">
        <div class="modal1-box-small">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/check.svg"/>
            </div>
            <div class="modal1-txt text-center modal-text">
            </div>
        </div>
    </div>
@elseif($modalType == 'error')
    <div class="modal1 d-none" id="error-modal">
        <div class="modal1-box-small">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/error.svg"/>
            </div>
            <div class="modal1-txt text-center modal-text">
            </div>
        </div>
    </div>
@elseif($modalType == 'close')
    <div class="modal1 d-none" id="close-modal">
        <div class="modal1-box-small modal-text">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/close.svg"/>
            </div>
            <div class="modal1-txt text-center">
            </div>
        </div>
    </div>
@endif