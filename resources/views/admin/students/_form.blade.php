<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            <label class="form-label">Picture</label>
            <input type="file" name="pic" class="form-control" id="imageUpload" accept="image/*">
        </div>
        <div class="mb-3">
            <img id="imagePreview"
                src="{{ isset($student) && $student->picture ? asset($student->picture) : asset('no_image.jpg') }}"
                alt="Image Preview" class="img-thumbnail"
                style="{{ isset($student) && $student->picture ? '' : 'display:none;' }} max-width:200px; height:auto;">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name', $student->name ?? '') }}" class="form-control"
                placeholder="Name">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="mb-3">
            <label class="form-label">Internship Year</label>
            <input type="text" name="internship_year"
                value="{{ old('internship_year', $student->internship_year ?? '') }}" class="form-control"
                placeholder="Internship Year">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="mb-3">
            <label class="form-label">Education</label>
            <input type="text" name="education" value="{{ old('education', $student->education ?? '') }}"
                class="form-control" placeholder="Education">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="mb-3">
            <label class="form-label">Internship with HFIP</label>
            <input type="text" name="service_attachment"
                value="{{ old('service_attachment', $student->service_attachment ?? '') }}" class="form-control"
                placeholder="Internship with HFIP">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="mb-3">
            <label class="form-label">Service with HFIP</label>
            <input type="text" name="internship_training"
                value="{{ old('internship_training', $student->internship_training ?? '') }}" class="form-control"
                placeholder="Service with HFIP">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="mb-3">
            <label class="form-label">Externship with IFHC</label>
            <input type="text" name="internship" value="{{ old('internship', $student->internship ?? '') }}"
                class="form-control" placeholder="Externship with IFHC">
        </div>
    </div>

    <div class="col-sm-12">
        <div class="mb-3">
            <label class="form-label">Present Status</label>
            <input type="text" name="present_status" value="{{ old('present_status', $student->present_status ?? '') }}"
                class="form-control" placeholder="Present Status">
        </div>
    </div>
</div>