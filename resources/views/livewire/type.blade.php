<div>
    @livewireStyles


        <div class="">
            <select name="DocumentType" class="form-control form-select" wire:model="selection">
                <option value="I" selected>فاتورة</option>
                <option value="C">إشعار دائن</option>
                <option value="D">إشعار مدين</option>

            </select>
        </div>

    @if (!is_null($selection) && $selection == 'C')
    <label for="">الرقم المرجعى اختيارى <span style="color: red">*</span></label>
        <div style="margin:auto;padding:10px">
            <input type="text" class="form-control text-center" type="text" name="referencesInvoice" placeholder="الرقم المرجعى">
        </div>
    @elseif(!is_null($selection) && $selection == 'D')
    <label for="">الرقم المرجعى اختيارى <span style="color: red">*</span></label>
        <div style="margin:auto;padding:10px">

            <input type="text" class="form-control text-center" type="text" name="referencesInvoice" placeholder="الرقم المرجعى">
        </div>
    @else

    @endif
    @livewireScripts
</div>
