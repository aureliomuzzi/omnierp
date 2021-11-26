<input  type="checkbox"
    data-handle-width="100"
    id="status"
    name="status"
    data-onstyle="success"
    data-offstyle="danger"
    value= "1", {{ isset($ativo) && $ativo->status == 1 ? 'checked' : 0  }}
/>
