@isset($form_contato)   
  <div class="modal fade" id="modal_contato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Contato</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="">Utilize o formulário abaixo para tirar quaisquer dúvidas conosco!</p>
          {!! form($form_contato) !!}
        </div>
      </div>
    </div>
  </div>

@endif