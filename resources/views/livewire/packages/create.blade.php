<form wire:submit="submit">
    <flux:card class="space-y-6">
        <div>
            <flux:heading size="xl">
                Submit Package
            </flux:heading>
            <flux:text class="mt-2">
                You can submit PHP and Javascipt packages. We ask that you submit only packages that are related to
                Laravel and it's ecosystem.
            </flux:text>
        </div>

        <flux:separator />

        <div class="space-y-8">
            <flux:input label="GitHub URL" wire:model="github_url" type="url" required
                description="We will parse the repository and extract package information." />

            <flux:field>
                <flux:label>Package Categories</flux:label>
                <flux:description>
                    Help others find your package by selecting the appropriate categories.
                </flux:description>
                <flux:select variant="listbox" searchable indicator="checkbox" placeholder="Select categories" multiple wire:model="categories">
                    @foreach ($this->availableCategories as $key => $category)
                        <flux:select.option value="{{ $key }}">
                            {{ $category }}</flux:select.option>
                    @endforeach
                </flux:select>
            </flux:field>

            <flux:radio.group label="Package Type" variant="segmented" wire:model="package_type" required
                description="The primary language of the package.">
                <flux:radio label="PHP" value="php" />
                <flux:radio label="Javascript" value="javascript" />
                <flux:radio label="Other" value="other" />
            </flux:radio.group>

            <flux:radio.group label="Installation Method" variant="segmented" wire:model="installation_method" required
                description="The primary installation method for the package.">
                <flux:radio label="Composer" value="composer" />
                <flux:radio label="NPM" value="npm" />
                <flux:radio label="Other" value="other" />
            </flux:radio.group>

            <flux:separator />

        </div>

        <div class="mt-8 flex justify-end">
            <flux:button variant="primary" type="submit">
                Submit Package
            </flux:button>
        </div>

    </flux:card>
</form>
