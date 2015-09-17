<?php
namespace Linfo\Laravel\Commands;

use Illuminate\Console\Command;
use Linfo\Laravel\Models\Linfo;
use Illuminate\Support\Str;

class LinfoGetCommand extends Command
{
    protected $signature = 'linfo:get {key : The key of the element you want to see}';
    protected $description = 'Display the requested linfo attributes.';

    protected $linfo;

    public function handle()
    {
        $key = strtolower($this->argument('key'));
        if(method_exists($this, 'display' . Str::studly($key) . 'Attribute')) {
            $this->linfo = new Linfo();
            $this->{'display' . Str::studly($key) . 'Attribute'}();
        } else {
            $this->error('pleas select a single key - cpu, ram, mounts');
        }
    }

    protected function displayCpuAttribute()
    {
        $cpu = $this->linfo->cpu;
        $headers = ['Vendor', 'Model', 'MHz', 'Usage ' . number_format($this->linfo->getProcessed('cpu')['usage_percentage'], 2) . '%'];
        $data = array_map(function($item) {
            return [
                $item['vendor'],
                preg_replace('/[\s]{2,}/', ' ', $item['model']),
                $item['mhz'],
                number_format($item['usage_percentage'], 2). '%',
            ];
        }, $cpu);
        $this->table($headers, $data);
    }

    protected function displayRamAttribute()
    {
        $ram = $this->linfo->getProcessed('ram');
        $this->info(round($ram['usage_percentage']) . '% usage of ' . round($ram['total_gb']) . 'GB ' . $ram['type'] . ' RAM');
        $this->comment('total=' . round($ram['total_gb']) . 'GB');
        $this->comment('free=' . round($ram['free_gb']) . 'GB');
        $this->comment('blocked=' . round($ram['blocked_gb']) . 'GB');
    }

    protected function displayMountsAttribute()
    {
        $mounts = $this->linfo->mounts;
        $headers = ['Device', 'Mount', 'Type', 'Size', 'Used', 'Free', 'Usage'];
        $data = array_map(function($item) {
            return [
                $item['device'],
                $item['mount'],
                $item['type'],
                number_format($item['size'] / 1024 / 1024 / 1024, 2) . 'GB',
                number_format($item['used'] / 1024 / 1024 / 1024, 2) . 'GB',
                number_format($item['free'] / 1024 / 1024 / 1024, 2) . 'GB',
                number_format($item['used_percent'], 2) . '%',
            ];
        }, $mounts);
        $this->table($headers, $data);
    }
}