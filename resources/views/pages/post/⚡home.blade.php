<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="flex flex-col items-start justify-center">
  <div class="flex flex-col items-center jusitfy-center">
    <flux:avatar size="xl" src="https://unavatar.io/x/calebporzio"/>
    <div class="flex items-center jusitfy-center gap-4 mt-4">
      <flux:avatar icon="user"/>
      <flux:avatar icon="phone"/>
      <flux:avatar icon="computer-desktop"/>
  </div>
  </div>
  <div>
    <div class="flex items-center gap-2">
      <flux:icon.star variant="solid" />
      <flux:icon.star variant="solid" />
      <flux:icon.star variant="solid" />
      <flux:icon.star variant="solid" />
      <flux:icon.star variant="solid" />
    </div>

    <div class="flex flex-col items-center jusitfy-center max-w-1/2">
      <flux:heading size="xl" class="mt-4 italic">
        <p>IMO Livewire takes Blade to the next level. It's basically what Blade should be by default. 🔥</p>
      </flux:heading>

      <div class="mt-6 flex items-center gap-4">
        <flux:avatar size="lg" src="https://unavatar.io/x/taylorotwell"/>
        <div>
          <flux:heading size="lg">Taylor Otwell</flux:heading>
          <flux:text>Creator of Laravel</flux:text>
        </div>
      </div>
  </div>
  </div>
  <div class="flex justify-between items-center mb-4 mt-12">
    <flux:heading size="lg">Team members</flux:heading>

    <flux:button size="sm" icon="plus">Invite</flux:button>
  </div>

  <flux:table>
    <flux:table.rows>
      <flux:table.row>
        <flux:table.cell>
          <div class="flex items-center gap-2 sm:gap-4">
            <flux:avatar circle size="lg" class="max-sm:size-8" src="https://unavatar.io/github/calebporzio" />
            <div class="flex flex-col">
              <flux:heading>Caleb Porzio <flux:badge size="sm" color="blue" class="ml-1 max-sm:hidden">You</flux:badge></flux:heading>
              <flux:text class="max-sm:hidden">caleb@laravel-livewire.com</flux:text>
            </div>
          </div>
        </flux:table.cell>

        <flux:table.cell>
          <div class="flex justify-end items-center gap-2">
            <flux:select size="sm" class="min-w-fit max-w-fit">
              <flux:select.option value="admin" selected>Admin</flux:select.option>
              <flux:select.option value="member">Member</flux:select.option>
              <flux:select.option value="guest">Guest</flux:select.option>
            </flux:select>
            <flux:button size="sm" variant="subtle" icon="trash" class="shrink-0" />
          </div>
        </flux:table.cell>
      </flux:table.row>

      <flux:table.row >
        <flux:table.cell>
          <div class="flex items-center gap-2 sm:gap-4">
            <flux:avatar circle size="lg" class="max-sm:size-8" src="https://unavatar.io/github/hugosaintemarie" />
            <div class="flex flex-col">
              <flux:heading>Hugo Sainte-Marie</flux:heading>
              <flux:text class="max-sm:hidden">hugo@example.com</flux:text>
            </div>
          </div>
        </flux:table.cell>

        <flux:table.cell>
          <div class="flex justify-end items-center gap-2">
            <flux:select size="sm" class="min-w-fit max-w-fit">
              <flux:select.option value="admin">Admin</flux:select.option>
              <flux:select.option value="member" selected>Member</flux:select.option>
              <flux:select.option value="guest">Guest</flux:select.option>
            </flux:select>
            <flux:button size="sm" variant="subtle" icon="trash" class="shrink-0" />
          </div>
        </flux:table.cell>
      </flux:table.row>

      <flux:table.row>
        <flux:table.cell>
          <div class="flex items-center gap-2 sm:gap-4">
            <flux:avatar circle size="lg" class="max-sm:size-8" src="https://unavatar.io/github/joshhanley" />
            <div class="flex flex-col">
              <flux:heading>Josh Hanley</flux:heading>
              <flux:text class="max-sm:hidden">josh@example.com</flux:text>
            </div>
          </div>
        </flux:table.cell>

        <flux:table.cell>
          <div class="flex justify-end items-center gap-2">
            <flux:select size="sm" class="min-w-fit max-w-fit">
              <flux:select.option value="admin">Admin</flux:select.option>
              <flux:select.option value="member" selected>Member</flux:select.option>
              <flux:select.option value="guest">Guest</flux:select.option>
            </flux:select>
            <flux:button size="sm" variant="subtle" icon="trash" class="shrink-0" />
          </div>
        </flux:table.cell>
      </flux:table.row>
    </flux:table.rows>
  </flux:table>
</div>
