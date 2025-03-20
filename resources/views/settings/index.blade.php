@extends('layouts.app')

@section('content')

<section class="max-w-4xl mx-auto flex gap-6 my-12">
        <aside class="max-w-1/3">
            <flux:heading size="lg">Manage Account</flux:heading>
            <flux:subheading>
                Your profile information is synced with your GitHub account, and is refreshed any time you log in.
            </flux:subheading>
        </aside>
        <main class="flex-1 space-y-4">
            <flux:card class="space-y-8">

                <flux:input 
                    value="{{ auth()->user()->name }}"
                    label="Name" 
                    description="This is publicly displayed."
                    readonly
                />

                <flux:input 
                    value="{{ auth()->user()->username }}"
                    label="Username" 
                    description="This is publicly displayed."
                    readonly
                />
                
                <flux:input 
                    value="{{ auth()->user()->email }}"
                    label="Email" 
                    description="This is never displayed publicly."
                    readonly
                />

                <flux:input 
                    value="{{ auth()->user()->website }}"
                    label="Website" 
                    description="This is publicly displayed if set."
                    readonly
                />

                <flux:textarea 
                    label="Bio" 
                    description="This is publicly displayed."
                    readonly
                >{{ auth()->user()->bio }}</flux:textarea>
                
            </flux:card>

            <flux:card class="space-y-4">

                <flux:heading size="lg">
                    Delete Account
                </flux:heading>


                <div class="prose prose-red prose-sm">
                    <p>
                        This action is irreversible. When you delete your account:
                    </p>
                    <ul>
                        <li>All of your content will be permanently deleted.</li>
                        <li>All of your starter kits posts will be permanently deleted.</li>
                        <li>All of your application recipes will be permanently deleted.</li>
                    </ul>
                </div>

                <flux:button variant="danger">
                    Delete Account
                </flux:button>
                
            </flux:card>
        </main>
</section>

@endsection

