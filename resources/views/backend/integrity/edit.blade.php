@extends('layouts.backend.app')

@section('title', 'Edit Pembobotan Nilai')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Edit Pembobotan Nilai</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('integrity.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        {{ __('Back to list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form role="form" id="integrityForm" action="{{ route('integrity.update', $integrity->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Pembobotan Nilai</h5>
                        <x-forms.textbox label="Deskripsi" name="description" value="{{ $integrity->description ?? '' }}" field-attributes="required"></x-forms.textbox>
                        <x-forms.textbox label="Bobot Nilai" name="integrity" value="{{ $integrity->integrity ?? '' }}" type="number" step="0.1" field-attributes="required"></x-forms.textbox>
                        <x-forms.textbox label="Nilai GAP" name="integrity_name" value="{{ $integrity->difference_value ?? '' }}" type="number" step="0.1" field-attributes="required"></x-forms.textbox>
                    </div>
                </div>

                <x-forms.button label="Reset" class="btn-danger" icon-class="fas fa-redo" on-click="resetForm('integrityForm')"/>
                <x-forms.button type="submit" label="Simpan" icon-class="fas fa-arrow-circle-up"/>
            </form>
        </div>
    </div>
@endsection
