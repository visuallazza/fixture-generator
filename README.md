# Fixture Generator
This package helps you to generate fixtures out of your DTO's. To be able to use the `fixture-generator` your DTO's has to extend the `DataTransferObject` of `Spatie`

```
use Spatie\DataTransferObject\DataTransferObject;

class YourDto extends DataTransferObject
{}
```

# Add the generator to your deps
```
composer require visuallazza/fixture-generator
}
```

# How to use
The method will generate an object with either with placeholder values. 

- `className`: Full qualified Name of the class
- `isComplete`: By default `true` all properties will be set, if `flase` only required properties will be set.  
- `dataSet`: Set each property as test case requires. The other properties will be set    

```
use Fixture\Generator\Models\Primitive;
use PHPUnit\Framework\TestCase;

class TestCase extends TestCase
{
    use HasFixtureGenerator;
    
    public function test(): void
    {
        $dataSet = [
            'int' => 5,
        ];
        
        $generatedObject = $this->generate(
            className: Primitive::class, 
            isComplete: false, 
            providedData: $dataSet
        );
    }
}
```

# Dependencies
To generate the objects the `spatie DTO` is in use.
```
"spatie/data-transfer-object": "^3.9",
```

# Test
Run all test with the make command
```
make test
```

# Lint

```
make lint
```
