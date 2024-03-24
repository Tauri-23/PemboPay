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



{{-- For Yes No Modals --}}
@elseif($modalType == 'error-yn')
    <div class="modal1 d-none" id="error-yn-modal">
        <div class="modal1-box-small modal-text">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/error.svg"/>
            </div>
            <div class="modal1-txt text-center">
            </div>
        </div>
    </div>

@elseif($modalType == 'close-yn')
    <div class="modal1 d-none" id="close-yn-modal">
        <div class="modal1-box-small modal-text">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/close.svg"/>
            </div>
            <div class="modal1-txt text-center">
            </div>
            <div class="d-flex justify-content-center gap1 mar-top-2">
                <a class="primary-btn2-small" id="modal-close-btn">No</a>
                <a class="yes-btn primary-btn3-small">Yes</a>
            </div>
        </div>
    </div>

@elseif($modalType == 'warning-yn')
    <div class="modal1 d-none" id="warning-yn-modal">
        <div class="modal1-box-small modal-text">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/crisis.svg"/>
            </div>
            <div class="modal1-txt text-center">
            </div>
        </div>
    </div>
@endif