@section('title', 'Edit Data Satuan')

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">
                <a href="{{ route('unit.index') }}">
                    <x-button.info-button>
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </x-button.info-button>
                </a>

                <x-form action="{{ route('unit.update', $unit->id) }}" class="md:grid md:grid-cols-2 gap-4">
                    @csrf
                    @method('PUT')

                    <div class="mt-4">
                        <x-input.input-label for="name" :value="__('Nama Satuan')" />
                        <x-input.text-input id="name" class="mt-1 w-full" type="text" name="name"
                            :value="old('name', $unit->name)" autofocus autocomplete="name" />
                        <x-input.input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input.input-label for="acronym" :value="__('Singkatan')" />
                        <x-input.text-input id="acronym" class="mt-1 w-full" type="text" name="acronym"
                            :value="old('acronym', $unit->acronym)" autofocus autocomplete="acronym" />
                        <x-input.input-error :messages="$errors->get('acronym')" class="mt-2" />
                    </div>


                    <div class="mt-4 col-span-2">
                        <x-input.input-label for="status" class="label cursor-pointer mr-6">
                            <x-input.checkbox name="status" id="status" :value="old('status', $unit->status) == true ? ' ' : ' checked'" :title="__('Sembunyikan?')" />
                        </x-input.input-label>
                    </div>

                    <div class="col-span-2">
                        <x-button.primary-button type="submit">
                            {{ __('Simpan') }}
                        </x-button.primary-button>
                    </div>

                </x-form>
            </x-card.card-default>
        </div>
    </div>

</x-app-layout>
