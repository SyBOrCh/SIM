<?php

namespace App;

class DataImporter
{
    protected $experiment;

    protected $regexLookup = [
        'protonNMR'     => '/((?:1H|1-H).*?NMR.*?)(?:\.|\;)\s/s',
        'carbonNMR'     => '/((?:13C|13-C).*?NMR.*?)(?:\.|\;)\s/s',
        'rfValue'       => '/(?:Rf|RF|rf|rF)\s*(?:=|\:)\s*(\d*\.\d*.*?)(?:,|\.)/s',
        'irData'        => '/(?:IR|Ir).*?(?:\:|=)\s*(\d.*?)(?:\.|\;)\s/s',
        'meltingPoint'  => '/(?:m.p.|MP|Melting\s*-?Point|M.P.|M.p.)\s*(?:\:|=)\s*(\d*(?:\s*-\s*\d*)?)/si',
        'HRMS'          => '/HRMS?.*?(?:calculated for|calcd|calculated|for)\s*((?:[A-Z][a-z]?\d*)+).*?(\d*\.\d*).*?(\d*\.\d*)/si',
        'rotation'      => '/=\s*([^\d\sA-Za-z]{1})\s*(\d*\.?\d*)\s*\(.*?=\s*(\d*\.?\d*),?\s*(.*?)\)/s',
    ];

    public function __construct(string $experiment)
    {
        $this->experiment = $experiment;
    }

    public function getProtonNMR()
    {
        return $this->match('protonNMR');
    }

    public function getCarbonNMR()
    {
        return $this->match('carbonNMR');
    }

    public function getRfValue()
    {
        return $this->match('rfValue');
    }

    public function getIrData()
    {
        return $this->match('irData');
    }

    public function getMeltingPoint()
    {
        return $this->match('meltingPoint');
    }

    public function getHRMS($type)
    {
        $hrmsArray = $this->matchMultiple('HRMS');

        switch ($type) {
            case 'formula':
                return $hrmsArray[1];
            case 'ion':
                return $this->resolveHRMSAdduct($hrmsArray[1]);
            case 'calculated':
                return $hrmsArray[2];
            case 'found':
                return $hrmsArray[3];
            default:
                return;
        }
    }

    public function getRotation($type)
    {
        switch ($type) {
            case 'sign':
                return $this->matchMultiple('rotation')[1];
            case 'value':
                return $this->matchMultiple('rotation')[2];
            case 'concentration':
                return $this->matchMultiple('rotation')[3];
            case 'solvent':
                return $this->matchMultiple('rotation')[4];
            default:
                return;
        }
    }

    protected function match($lookup)
    {
        $regex = $this->regexLookup[$lookup];

        preg_match($regex, $this->experiment, $match);

        if (empty($match)) {
            return;
        }

        return $match[1];
    }

    protected function matchMultiple($lookup)
    {
        $regex = $this->regexLookup[$lookup];

        preg_match($regex, $this->experiment, $matches);

        if (empty($matches)) {
            return;
        }

        return $matches;
    }

    protected function resolveHRMSAdduct($formula)
    {
        $regex = '/([A-Z][a-z]?)(\d*)/';
        preg_match_all($regex, $formula, $matches);

        if (in_array('Na', $matches[1])) {
            return 'Na+';
        }

        return 'H+';
    }
}
