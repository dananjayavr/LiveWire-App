Installation
------------
Install LiveWire in an already existing app: 

composer require livewire/livewire

Make sure to remove Alpine from the project (Blade + Alpine option with the breeze project)

Also, you can create a new project using JetStream preset (Choose LiveWire as the option). Then run npm run dev from the
project directory

Components
----------

Component = Blade View + PHP Class

To make a component: php artisan make:livewire <component_name>. e.g., php artisan make:livewire greeter
Class will be located in app/LiveWire folder while the associated view will be created in view/livewire folder

Then use the the component in the Blade view: 

<livewire:greeter/>

Greeter.php => Class (kind of like a controller)
Class will render the view below
We can pass the data from properties in the class (like a Model in a real controller)
Those public properties are directly accessible from the view below

greeter.blade.php => Component View


Actions
-------

Action is a public method in the component class 
ex: 

public $name = 'Jeremy';

public function changeName($newName)
{
$this->name = $newName;
}

Then, how can we call this method from the view ? 
For example, with wire:click (equivalent of onclick in normal HTML) 

<button wire:click="changeName('Jeffrey')">Greet</button>

To get data from an HTML element (ex. input field) and send it to the component, we can: 

<input id="newName" type="text" />
<button wire:click="changeName(document.getElementById('newName').value)">Greet</button>

This works, as long as we click on the button after typing the name in the input field. 

How about if I want to press enter and want to send the input field data to the component ? 

We can wrap the two elements in a <form> and use wire:submit action with same properties as above: 

<form wire:submit.prevent="changeName">
    <input wire:model="name" type="text" />
    <button type="submit">Greet</button>
</form>

Binding Data
------------

In the above snippets, we still used JavaScript. Now we want to only use PHP. The idea is to "bind" the input field
value to the $name property defined in the component class. 

<input wire:model="name" type="text" />

Note that this is a two-way bind, so any modification to the property in the class will be reflected in the component

Also in this case we wouldn't even need the changeName function parameter as the wire:model will automatically update
the $name property server-side. The server is updated whenever we submit the form in the current implementation. This
is also the default behaviour.

to change this behaviour, we can modify the wire:model property: 

<input wire:model.live="name" type="text" />. live: update the property in the server every keystroke
<input wire:model.live.debounce="name" type="text" /> debounce: do the same but add a slight delay before updating the
server

<input wire:model.live.debounce.1000ms="name" type="text" /> 1000ms: add a 1s delay before sending the update to the server

also, adding wire:model.change will update the server everytime the focus is shifted from the element in question

When we want to use the default value of a select dropdown and send it to the component property in the server, we can: 

<select wire:model.fill="greeting">
  <option value="hello">Hello</option>
  <option value="hi">Hi</option>
  <option value="hey">Hey</option>
  <option value="howdy">Howdy</option>
</select>

the .fill property makes it so that the matching $greeting variable in the component PHP clas takes up the defaulut value
from the HTML

Upshot is that you can set default values either in the HTML or from the class itself. All depends on the use case. 

Validation
----------

Rule of Thumb: Never Trust the User Input

Validation is done much the same way as from within a regular Laravel controller: 


$this->validate([
'name' => 'required|min:2',
]);

This could be called for example within the changeName function. 

In order to reset the individual properties from the component class, you can call $this->reset('name'); for example

To display validation errors, use the @error('name){{$message}} @enderror as normal 
You can also use $this->validate() in conjunction with public function rules(), as you would do in a normal Laravel
controller

Another way to do this would be: 

#[\Livewire\Attributes\Validate(['required', 'min:2'])]
public $name;

This way we keep the validation rules next to the property that they apply to. So no need to call validate() method 
LiveWire takes care of validation 
But you'd still need to call the validate method, if you want to stop executing code after that point. Where as without it,
the code will display the error message in the frontend but still process the wrong input

bottom line: always call the validate() method from the component class, unless otherwise stated


Lifecycle Hooks
---------------

Mount = load event of the browser (when the component is loaded in the view)

e.g., public function mount()

Side note: when creating a component, you can also supply a -m option to generate a migration along with it

For example we can declare an array property within the class 

public $greetings

then let's say we fetch the greetings from the database inside the mount() function :

$greetings = Greeting::all();

Then, in the view we can iterate over this array in the view to populate our options of the select menu

Update = executed everytime we update a component (e.g., type a name to the input field and submit)

e.g., public function updated($property, $value);


public function updated($propertyName, $value)
{
    if ($propertyName === 'name') {
    $this->name = strtolower($value);
    }
}

The above is the more generic version, if you want a more specific updated method with a property we can also: 

public function updatedName($value)
{
$this->name = strtolower($value);
}

in this case it'll be executed everytime the $name property gets updated

If you want to prevent the default action associated with a component from occurring, example submit action of a form, 
you can use prevent : wire:click.prevent
This way it overrides the default action and instead executes whatever method we wired up with the element

Full page components
--------------------

In order to associate a route with a component, you can:
Route::get('/search',Search::class)->name('search');
Search.php is the class that is associated with the Search livewire component

Running php artisan livewire:layout will create a layout (views/components/layouts/app.blade.php)

Nesting Components
------------------

You can inject properties dynamically

public $placeholder = 'Type something to search'; // inside the class
<input type="text" placeholder="{{ $placeholder }}"> <!-- inside the component view -->

meaning you can do : 

<livewire:search placeholder="Search users..." />

You can also do this within another component: 

<livewire:search-results :results="$results" />

in that case you should have $results property inside SearchResults.php and you should've marked it as reactive:
Add the #[\Livewire\Attributes\Reactive] attribute
That means, whenever the results gets updated in the parent component, the child search-results component also gets updated

    #[Reactive]
    public $results = [];

Events
------

Events are used to communicate from one component to another
A child component can dispatch and event like so (from inside a method) :

$this->dispatch('search:clear-results');

a parent component can listen to this event and execute a method : 

    #[On('search:clear-results')]
    public function clear()
    {
        $this->reset(['results','searchText']);
    }

You can also dispatch an event directly from the component:

<button type="button" wire:click="dispatch('search:clear-results')">x</button>

You can also dispatch the same event using Alpine JS library: 

Just add the following properties to <body> for example: 

x-data x-on:click="$dispatch('search:clear-results')"

Be careful that this is JavaScript, not PHP

Of course, you can also listen to the events using plain JS: 

document.addEventListener('searchClearResults', () => {
console.log('Cleared results');
});


Dashboard
---------

Use #[Title('Articles')] on top of the component class declaration to set the title for the component view from the class
Use #[Layout('components.layouts.admin')] on a base class to specify a layout for all the components that's extending this baseclass


Forms
-----

Use php artisan livewire:form <formname> command to simplify create/edit forms to keep component code lean

Reading model properties from JavaScript (Alpine). You can do something like this:

<div class="mb-3" x-show="$wire.form.allowNotifications">

This means that the element will be hidden, depending on the boolean value defined in allowNotifications property in the component code.

Also, to track when various fields of a form has changed, you can use : 

            <div class="mb-2" wire:dirty.class="text-orange-400" wire:target="form.notifications">
                Notification Options<span wire:dirty wire:target="form.notifications">*</span>
            </div>

here wire:dirty.class element will be added to the div whenever the property watched by wire:target gets changed

You can also do this with buttons:  

        <button
            class="text-white p-2 bg-indigo-700  rounded-sm disabled:opacity-75 disabled:bg-blue-300"
            type="submit"
            wire:dirty.class="hover:bg-indigo-900"
            wire:dirty.attr.remove="disabled"
            disabled
        >

Here the button will remain disabled, unless some field gets changed in the form 
