<? // mui ?>

<form
  action="<?= @$content['form-note-publish']['form-action'] ?>"
  method="post"
  onsubmit="e2ljSubmit()"
>

<input
  type="hidden"
  name="note-id"
  value="<?= @$content['form-note-publish']['.note-id'] ?>" 
/>

<input
  type="hidden"
  id="gmt-offset"
  name="gmt-offset"
  value="unknown"
/>

<script>
d = new Date ()
document.getElementById ('gmt-offset').value = - d.getTimezoneOffset()
</script>

<div class="form">

<div class="form-control">

  <div style="display: none">
  <div class="label input-label"><label><?= _S ('ff--alias') ?></label></div>
  <input type="text"
    class="text required unedited width-2"
    autocomplete="off"
    tabindex="1"
    id="alias"
    name="alias"
    value="<?= @$content['form-note-publish']['suggested-alias'] ?>"
  />
  </div>

  <div class="submit-box">
    <button type="submit" id="submit-button" class="button submit-button">
      <?= @$content['form-note-publish']['submit-text'] ?>
    </button>
    <div class="e2lj-chbx">
      <input type="checkbox" id="e2lj-checkbox"> <label for="e2lj-checkbox">Отправить в ЖЖ</label>
    </div>
  </div>

</div>

</div>


</form>