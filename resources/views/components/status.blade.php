<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Ativar ou Inativar</h3>
    </div>
    <div class="card-body text-center">
        <input  type="checkbox"
            data-handle-width="100"
            id="status"
            name="status"
            data-onstyle="success"
            data-offstyle="danger"
            value= "1", {{ $status == 1 ? 'checked' : 0  }}
        />
    </div>
</div>