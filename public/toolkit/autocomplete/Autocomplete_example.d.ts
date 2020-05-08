import sf, { IOptionToGrab, ISpiralFramework } from '@spiral-toolkit/core';
import { IAutoCompleteOptions } from './types';
export declare class Autocomplete extends sf.core.BaseDOMConstructor {
    static readonly spiralFrameworkName: string;
    readonly name: string;
    static defaultOptions: IAutoCompleteOptions;
    el?: HTMLDivElement;
    readonly optionsToGrab: {
        [option: string]: IOptionToGrab;
    };
    options: IAutoCompleteOptions;
    sf: ISpiralFramework;
    textInput: HTMLInputElement;
    hiddenInput: HTMLInputElement;
    constructor(ssf: ISpiralFramework, node: Element, options: IAutoCompleteOptions);
    onInput(): void;
    setValue(val: string): void;
    bind(): void;
    die(): void;
}
export default Autocomplete;
