# What is EvoCSS?
EvoCSS is a SASS framework which provides you with a solid architectural foundation to build your project CSS.

This isn't a UI toolkit, and doesn't provide any form of ready-made components out of the box (Like Bootstrap for example). EvoCSS can be used on any and all types of project without dictating a look-and-feel, and helps you by:

- Implementing reset and rebuild styles to improve cross-browser consistency.
- Including undecorated object design patterns which you can reuse over and over.
- Providing a few minor utility classes to perform the most common tasks.
- Giving you a ready-made directory sturcture based on [ITCSS](https://www.creativebloq.com/web-design/manage-large-css-projects-itcss-101517528) to make your project styles simple, easy to use and scalable.

# Installing EvoCSS
There are 3 main ways to install EvoCSS.

### New Projects
In brand new projects, starting from fresh, you can leverage all of EvoCSS' features and functionality. Make sure you have [Node.js](https://nodejs.org) installed and then run the below command in terminal:

```
npm install evocss --save
```

Next, copy its `node_modules/evocss/main.scss` to your projects `css` directory, then edit its `@import` paths so they correctly link to each respective file in `node_modules/evocss`.

### New Projects (Alternative)
Simply clone the repo and then copy `main.scss` and each of the [ITCSS](https://www.creativebloq.com/web-design/manage-large-css-projects-itcss-101517528) layer directories to your project's `css` directory. This method is not recommended because you lose the ability to easily and quickly manage and update EvoCSS as a dependency.

### For Existing Projects
The quickest way to introduce EvoCSS to an existing codebase (main repo etc) is to add this snippet in the `<head>` of your HTML, _**before**_ your project stylesheet. The CSS file in the snippet is versioned, so when updates to EvoCSS are released, it doesn't cause bugs in existing projects which leverage the framework. In your project stylesheet, you will then be able to use any of EvoCSS's object or utilities classes.

_**Note:**_ One downside of this method is that because you're only importing compiled CSS, you're unable to leverage any EvoCSS mixins in your own project styles.

```
<link rel="stylesheet" href="https://evocss.evolutionfunding.com/evocss.0.0.1.css">
```

_**Make sure to replace the version number in the filename with the latest release.**_

### Compiling to CSS
Unless you're importing EvoCSS directly as a compiled CSS file, you will need to add a SASS build step to your project. You can do so through third party build systems such as [Gulp](https://gulpjs.com/) ([Click here](http://ryanchristiani.com/getting-started-with-gulp-and-sass/) for a tutorial, or see [Mike Brewer Motors website repo](https://github.com/EvolutionFunding/MBM-Website)), or you can build specific tasks using NPM scripts ([Click here](https://css-tricks.com/why-npm-scripts/) for a tutorial, or see [packages.json](https://github.com/EvolutionFunding/EvoCSS/blob/master/package.json)).

# CSS Directory Structure
EvoCSS follows a specific directory structure, which you should follow as well in your own CSS directory if you're importing EvoCSS as a dependency via NPM. This structure is called Inverted Triangle CSS ([ITCSS](https://www.creativebloq.com/web-design/manage-large-css-projects-itcss-101517528)).

- `/settings`: Global variables, site-wide settings, config switches, etc.
- `/tools`: Site-wide mixins and functions.
- `/generic`: Low-specificity, far-reaching rulesets (e.g. resets).
- `/elements`: Unclassed HTML elements (e.g. a {}, blockquote {}, address {}).
- `/objects`: Objects, abstractions, and design patterns (e.g. .o-layout {}).
- `/components`: Discrete, complete chunks of UI (e.g. .c-carousel {}). This is the one layer that EvoCSS doesn’t provide code for, as this is completely your terrain.
- `/utilities`: High-specificity, very explicit selectors. Overrides and helper classes (e.g. .u-hidden {}).

Following this structure allows you to intersperse EvoCSS’ code with your own, so that your main.scss file might look something like this:

```
// Settings
@import "/node_modules/evocss/settings/settings.breakpoints";
@import "/node_modules/evocss/settings/settings.colors";
@import "/node_modules/evocss/settings/settings.grid-system";
@import "/node_modules/evocss/settings/settings.spacing";
@import "/node_modules/evocss/settings/settings.typography";

// Tools
@import "/node_modules/sass-mq/mq";
@import "/node_modules/evocss/tools/tools.rem";
@import "/node_modules/evocss/tools/tools.color";
@import "tools/tools.clearfix";

// Generic
@import "/node_modules/normalize.css/normalize.css";
@import "/node_modules/evocss/generic/generic.box-sizing";
@import "/node_modules/evocss/generic/generic.reset";

// Elements
@import "/node_modules/evocss/elements/elements.headings";
@import "/node_modules/evocss/elements/elements.images";
@import "/node_modules/evocss/elements/elements.lists";
@import "/node_modules/evocss/elements/elements.page";
@import "/node_modules/evocss/elements/elements.paragraphs";
@import "/elements/elements.inputs";

// Objects
@import "/node_modules/evocss/objects/objects.box";
@import "/node_modules/evocss/objects/objects.container";
@import "/node_modules/evocss/objects/objects.cover";
@import "/node_modules/evocss/objects/objects.layout";
@import "/node_modules/evocss/objects/objects.list-bare";
@import "/node_modules/evocss/objects/objects.list-inline";
@import "/node_modules/evocss/objects/objects.media";
@import "/objects/objects.expander";

// Components
@import "/components/components.carousel";
@import "/components/components.header";
@import "/components/components.icons";
@import "/components/components.tabs";

// Utilities
@import "/node_modules/evocss/utilities/utilities.hide";
@import "/node_modules/evocss/utilities/utilities.spacing";
@import "/node_modules/evocss/utilities/utilities.widths";
```

Having your own and EvoCSS partials interlaced like this is one of the real strengths of this approach. For documentation explaining each EvoCSS import, check the respective source file.

# Contributing
I encourage everybody to contribute towards this framework to help it better meet our needs. Submit a pull request containing your changes and we'll see if it has merit.

Where possible, explain your thinking in the code with comments, as this benefits other developers using the framework. See `/elements/_elements.images.scss` for a good example of this.

### Building
When developing EvoCSS, the first thing you should do (assuming you already have [Node.js](https://nodejs.org) installed) is to run `npm install` to install project dependencies. From this point on in terminal, the following commands are available to you:

- `npm run build` - Lints and then compiles `main.scss` into a minified `dist/main.css`.
- `npm run build-debug` - Compiles `main.scss` into a non-minified `dist/main.css` so you can clearly read the CSS for debugging purposes.
- `npm run build-version` - Compiles `main.scss` into a minified `dist/evocss.VERSION_NUMBER.css` with the correct version number. On merge to master, this build task is run and the contents automatically uploaded to the evo server so it can be used as a direct include in smaller projects. A `dist/evocss.css` is also generated and then uploaded so we have an alternative file available which is always the latest version (Currently used by the [EvoCSS sandbox](https://codepen.io/lukedidit/pen/rdZONg)).
- `npm run lint` - Lints all SASS according to the ruleset defined in `.stylelintrc`. Read [stylelint](https://stylelint.io/) and the [stylelint-scss](https://github.com/kristerkari/stylelint-scss) plugin pages for more info on these.
- `npm run watch` - Watches all SASS files and when changes are detected, rebuilds the project automatically. If you're making lots of changes, it's recommended that you have this running so you don't have to keep rebuilding all the time.

### Recommended Reading

To properly understand the thinking behind EvoCSS, I recommend reading up on the following popular naming & folder structure convensions.

- [BEM](https://css-tricks.com/bem-101/) (Block, Element, Modifier)
- [OOCSS](https://www.smashingmagazine.com/2011/12/an-introduction-to-object-oriented-css-oocss/) (Object Oriented CSS)
- [ITCSS](https://www.creativebloq.com/web-design/manage-large-css-projects-itcss-101517528) (Inverted Triangle CSS)

# Sandbox
[Here](https://codepen.io/lukedidit/pen/rdZONg) is a Codepen sandbox where you can test and experiment with the compiled version of EvoCSS. It automatically pulls through the latest version.

# Misc
EvoCSS is a stripped down version of [OrionCSS](https://github.com/WebDevLuke/OrionCSS), which itself is my own take on another popular framework called [InuitCSS](https://github.com/inuitcss/inuitcss).

