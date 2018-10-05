@foreach(config('app.locales') as $locale => $locale_name)
    <div class="row">
        <!-- text -->
        <div class="form-group col-6">
            <label for="{{ "text-$locale" }}">Text ({{ $locale }})</label>
            <input type="text"
                   class="form-control {{ $errors->has("text.$locale") ? 'is-invalid' : null }}"
                   id="{{ "text-$locale" }}"
                   name="{{ "text[$locale]" }}"
                   placeholder="Enter link text..."
                   value="{{ old("text.$locale", optional($link)->getTranslation('text', $locale)) }}"
            >
            {!! $errors->first("text.$locale", '<small class="form-text text-danger">:message</small>') !!}
        </div>

        <!-- title -->
        <div class="form-group col-6">
            <label for="{{ "title-$locale" }}">Title attribute ({{ $locale }})</label>
            <input type="text"
                   class="form-control {{ $errors->has("title.$locale") ? 'is-invalid' : null }}"
                   id="{{ "title-$locale" }}"
                   name="{{ "title[$locale]" }}"
                   placeholder="Enter link title..."
                   value="{{ old("title.$locale", optional($link)->getTranslation('title', $locale)) }}"
            >
            {!! $errors->first("title.$locale", '<small class="form-text text-danger">:message</small>') !!}
        </div>
    </div>
@endforeach

<div class="row">
    <!-- url -->
    <div class="form-group col-3">
        <label for="url">URL</label>
        <input type="text"
               class="form-control {{ $errors->has('url') ? 'is-invalid' : null }}"
               id="url"
               name="url"
               placeholder="Enter link url..."
               value="{{ old('url', optional($link)->url) }}"
        >
        {!! $errors->first('url', '<small class="form-text text-danger">:message</small>') !!}
    </div>


    <!-- action -->
    <div class="form-group col-3">
        <label for="action">Controller Action</label>
        <input type="text"
               class="form-control {{ $errors->has('action') ? 'is-invalid' : null }}"
               id="action"
               name="action"
               placeholder="Controller@method"
               value="{{ old('action', optional($link)->action) }}"
        >
        {!! $errors->first('action', '<small class="form-text text-danger">:message</small>') !!}
    </div>

    <!-- route -->
    <div class="form-group col-3">
        <label for="route">Route name</label>
        <input type="text"
               class="form-control {{ $errors->has('route') ? 'is-invalid' : null }}"
               id="route"
               name="route"
               placeholder="Enter link 'route.name'... "
               value="{{ old('route', optional($link)->route) }}"
        >
        {!! $errors->first('route', '<small class="form-text text-danger">:message</small>') !!}
    </div>

    <!-- params -->
    <div class="form-group col-3">
        <label for="params">Parameters (route / action)</label>
        <input type="text"
               class="form-control {{ $errors->has('params') ? 'is-invalid' : null }}"
               id="params"
               name="params"
               placeholder='Parameters as JSON: {"attr": "val"}'
               value="{{ old('params', optional($link)->getOriginal('params')) }}"
        >
        {!! $errors->first('params', '<small class="form-text text-danger">:message</small>') !!}
    </div>
</div>

<div class="row">
    <!-- parent_class -->
    <div class="form-group col-3">
        <label for="parent_class">Parent class</label>
        <input type="text"
               class="form-control {{ $errors->has('parent_class') ? 'is-invalid' : null }}"
               id="parent_class"
               name="parent_class"
               placeholder="Enter link parent_class..."
               value="{{ old('parent_class', optional($link)->parent_class) }}"
        >
        {!! $errors->first('parent_class', '<small class="form-text text-danger">:message</small>') !!}
    </div>

    <!-- class -->
    <div class="form-group col-3">
        <label for="class">Class</label>
        <input type="text"
               class="form-control {{ $errors->has('class') ? 'is-invalid' : null }}"
               id="class"
               name="class"
               placeholder="Enter link class..."
               value="{{ old('class', optional($link)->class) }}"
        >
        {!! $errors->first('class', '<small class="form-text text-danger">:message</small>') !!}
    </div>

    <!-- parent_attrs -->
    <div class="form-group col-3">
        <label for="parent_attrs">Parent attributes</label>
        <input type="text"
               class="form-control {{ $errors->has('parent_attrs') ? 'is-invalid' : null }}"
               id="parent_attrs"
               name="parent_attrs"
               placeholder='Attributes as JSON: {"attr": "val"}'
               value="{{ old('parent_attrs', optional($link)->getOriginal('parent_attrs')) }}"
        >
        {!! $errors->first('parent_attrs', '<small class="form-text text-danger">:message</small>') !!}
    </div>

    <!-- attrs -->
    <div class="form-group col-3">
        <label for="attrs">Attributes</label>
        <input type="text"
               class="form-control {{ $errors->has('attrs') ? 'is-invalid' : null }}"
               id="attrs"
               name="attrs"
               placeholder='Attributes as JSON: {"attr": "val"}'
               value="{{ old('attrs', optional($link)->getOriginal('attrs')) }}"
        >
        {!! $errors->first('attrs', '<small class="form-text text-danger">:message</small>') !!}
    </div>
</div>

<div class="form-control mb-3">
    <div class="custom-control custom-checkbox">
        <input type="hidden" name="_blank" value="0">
        <input type="checkbox"
               class="custom-control-input"
               name="_blank"
               value="1"
               id="_blank"
               {{ old('_blank', optional($link)->_blank) == 1 ? 'checked' : null }}
        >
        <label class="custom-control-label"
               style="width: 100%;"
               for="_blank"
        >
            Open link in new tab
        </label>
    </div>
</div>