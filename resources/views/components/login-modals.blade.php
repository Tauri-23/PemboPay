@if($modalType == 'wrong-credentials')
    <div class="modal1 d-none" id="credential-no-match">
        <div class="modal1-box-small">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/error.svg"/>
            </div>
            <div class="modal1-txt text-center">
                Credentials Doesnt Match
            </div>
        </div>
    </div>
@endif