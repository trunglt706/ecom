<div class="form-group">
    <label for="lang" class="control-label">{{ System::lang('administrator/global.lang') }} *</label>
    <select class="select2-lang" id="lang" name="lang" data-placeholder="- {{ System::lang('administrator/global.lang') }} -">
        @foreach (System::lang('administrator/data.config.languages') as $key=>$val)
        <option value="{{ $key }}">
            {{ $val }}
        </option>
        @endforeach
    </select>
</div>
<script>
    function formatLang (state) {
      if (!state.id) { return state.text; }
      var $state = $(
        '<span><img src="{{ url("dist/com/com_languages/images") }}/' + state.element.value.toLowerCase() + '.gif" class="img-flag" /> ' + state.text + '</span>'
      );
      return $state;
    };
    $(".select2-lang").select2({
        templateResult: formatLang,
        templateSelection: formatLang,
        width: '100%',
        language: '{{ App::getLocale() }}'
    });
</script>
