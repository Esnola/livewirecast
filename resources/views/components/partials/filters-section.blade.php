<div class="flex justify-between items-center mb-6">
  <div class="flex items-center gap-2">
    <div class="flex items-center gap-2">
      <flux:select size="sm" class="">
        <flux:select.option>Last 7 days</flux:select.option>
        <flux:select.option>Last 14 days</flux:select.option>
        <flux:select.option selected>Last 30 days</flux:select.option>
        <flux:select.option>Last 60 days</flux:select.option>
        <flux:select.option>Last 90 days</flux:select.option>
      </flux:select>

      <flux:subheading class="whitespace-nowrap">compared to</flux:subheading>

      <flux:select size="sm">
        <flux:select.option selected>Previous period</flux:select.option>
        <flux:select.option>Same period last year</flux:select.option>
        <flux:select.option>Last month</flux:select.option>
        <flux:select.option>Last quarter</flux:select.option>
        <flux:select.option>Last 6 months</flux:select.option>
        <flux:select.option>Last 12 months</flux:select.option>
      </flux:select>
    </div>

    <flux:separator vertical class="max-lg:hidden mx-2 my-2"/>

    <div class="max-lg:hidden flex justify-start items-center gap-2">
      <flux:subheading class="whitespace-nowrap">Filter by:</flux:subheading>

      <flux:badge as="button" rounded color="zinc" icon="plus" size="lg">Amount</flux:badge>
      <flux:badge as="button" rounded color="zinc" icon="plus" size="lg">Status</flux:badge>
      <flux:badge as="button" rounded color="zinc" icon="plus" size="lg">More filters...</flux:badge>
    </div>
  </div>
</div>
