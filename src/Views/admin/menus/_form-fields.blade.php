<div class="row">
    <!-- name -->
    <div class="form-group col-3">
        <label for="name">Name <strong>*</strong></label>
        <input type="text"
               class="form-control {{ $errors->has('name') ? 'is-invalid' : null }}"
               id="name"
               name="name"
               placeholder="Enter menu name..."
               value="{{ old('name', optional($menu)->name) }}"
        >
        {!! $errors->first('name', '<small class="form-text text-danger">:message</small>') !!}
    </div>

    <!-- class -->
    <div class="form-group col-3">
        <label for="class">Class</label>
        <input type="text"
               class="form-control {{ $errors->has('class') ? 'is-invalid' : null }}"
               id="class"
               name="class"
               placeholder="Enter menu class..."
               value="{{ old('class', optional($menu)->class) }}"
        >
        {!! $errors->first('class', '<small class="form-text text-danger">:message</small>') !!}
    </div>

    <!-- children_class -->
    <div class="form-group">
        <label for="children_class">Children class</label>
        <input type="text"
               class="form-control {{ $errors->has('children_class') ? 'is-invalid' : null }}"
               id="children_class"
               name="children_class"
               placeholder="Enter menu children_class..."
               value="{{ old('children_class', optional($menu)->children_class) }}"
        >
        {!! $errors->first('children_class', '<small class="form-text text-danger">:message</small>') !!}
    </div>

    <!-- attrs -->
    <div class="form-group col-3">
        <label for="attrs">Attributes</label>
        <input type="text"
               class="form-control {{ $errors->has('attrs') ? 'is-invalid' : null }}"
               id="attrs"
               name="attrs"
               placeholder='Attributes as JSON: {"attr": "val"}'
               value="{{ old('attrs', optional($menu)->getOriginal('attrs')) }}"
        >
        {!! $errors->first('attrs', '<small class="form-text text-danger">:message</small>') !!}
    </div>
</div>