//===================FUNÇÃO PARA VERIFICAR VALIDAÇÃO DE FORMULÁRIO ======================
    $(function () {
      'use strict'
      const forms = document.querySelectorAll('.requires-validation')
      Array.from(forms).forEach(function (form) 
      {
        form.addEventListener('submit', function (event) {
          if(!form.checkValidity()) 
          {
            event.preventDefault()
            event.stopPropagation()
            // FOCA NO PRIMEIRO CAMPO INVÁLIDO
            let firstInvalid = form.querySelector(':invalid')
            if (firstInvalid) 
            {
              firstInvalid.focus()
              firstInvalid.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
              });
            }
          }
            form.classList.add('was-validated')
        }, false)
      })
    });

    //===============FUNÇÃO PARA EXIBIR TOAST DE SUCESSO OU ERRO APÓS AÇÃO ============
    function showToast(message, type = 'success') {

      let bg = 'bg-success';

      if (type === 'error') {
        bg = 'bg-danger';
      }

      if (type === 'warning') {
        bg = 'bg-warning';
      }

      let toast = $(`
        <div class="toast ${bg} text-white border-0 mb-3 shadow-lg"
             role="alert"
             style="
                min-width: 400px;
                padding: 10px;
                border-radius: 12px;
                font-size: 1rem;
             ">
             
            <div class="d-flex align-items-center">

                <div class="toast-body"
                     style="
                        padding: 15px 20px;
                        font-weight: 600;
                        line-height: 1.5;
                     ">
                    ${message}
                </div>
            </div>
        </div>
      `);

      $("#toast-container").append(toast);

      let bsToast = new bootstrap.Toast(toast[0], {
        delay: 3000 // 3 segundos
      });

      bsToast.show();

      toast.on('hidden.bs.toast', function() {
        $(this).remove();
      });
    }
     // ============================REMOVER USUÁRIO ==========================
    function removeFunc(id)
    {
      if(id) {
        $("#removeForm").off('submit').on('submit', function(e) {
          e.preventDefault();
          var form = $(this);
          $(".text-danger").remove();
          $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: { id: id }, 
            dataType: 'json',
            success:function(response) {
              if(response.success) {
                showToast(response.messages, 'success');
                $("#removeModal").modal('hide');
                setTimeout(() => {location.reload();}, 1000);// ou manageTable.ajax.reload(null, false);
              }else{
                showToast(response.messages, 'error');
              }
            }
          }); 
          return false;
        });
      }
    }