<form wire:submit="submit">
    <flux:card class="space-y-6">
        <div>
            <flux:heading size="xl">
                Submit Starter Kit
            </flux:heading>
            <flux:text class="mt-2">
                You can submit starter kits for Laravel. We ask that you submit only starter kits that are related to
                Laravel and it's ecosystem. We will review your starter kit and get back to you as soon as possible.
            </flux:text>
        </div>

        <flux:separator />

        <div class="space-y-6">
            <flux:input label="Name" wire:model="name" required
                description="Choose something descriptive, that will help users find it." />

            <flux:input label="GitHub URL" wire:model="github_url" type="url" required
                description="We will parse the repository and extract kit information." />

            <flux:radio.group label="Templating Engine" variant="segmented" wire:model="templating_engine" required
                description="The primary templating engine of the kit.">
                <flux:radio label="Livewire" value="livewire" />
                <flux:radio label="Blade" value="blade" />
                <flux:radio label="React" value="react" />
                <flux:radio label="Vue" value="vue" />
                <flux:radio label="Svelte" value="svelte" />
                <flux:radio label="Other" value="other" />
            </flux:radio.group>

            <flux:radio.group label="Inertia" variant="segmented" wire:model="inertia" required
                description="Whether the kit uses Inertia.">
                <flux:radio label="Yes" value="yes" />
                <flux:radio label="No" value="no" />
            </flux:radio.group>

            <flux:radio.group label="Panel Builder" variant="segmented" wire:model="panel_builder" required
                description="Whether the kit uses a panel builder.">
                <flux:radio label="Yes" value="yes" />
                <flux:radio label="No" value="no" />
            </flux:radio.group>

            <flux:radio.group label="Authentication" variant="segmented" wire:model="authentication" required
                description="Whether the kit uses authentication.">
                <flux:radio label="Yes" value="yes" />
                <flux:radio label="No" value="no" />
            </flux:radio.group>

            <flux:radio.group label="CSS Framework" variant="segmented" wire:model="css_framework" required
                description="The primary CSS framework of the kit.">
                <flux:radio label="Tailwind CSS" value="tailwind" />
                <flux:radio label="Bootstrap" value="bootstrap" />
                <flux:radio label="Other" value="other" />
            </flux:radio.group>

        </div>

        <div class="mt-8 flex justify-end">
            <flux:button variant="primary" type="submit">
                Submit Starter Kit
            </flux:button>
        </div>

    </flux:card>
</form>