import sf, { IOptionToGrab, ISpiralFramework } from '@spiral-toolkit/core';
import { IQRCodeOptions } from './types';
export declare class QRCode extends sf.core.BaseDOMConstructor {
    static readonly spiralFrameworkName: string;
    static readonly spiralFrameworkCssName: string;
    static readonly defaultOptions: IQRCodeOptions;
    options: IQRCodeOptions;
    readonly name: string;
    readonly optionsToGrab: {
        [option: string]: IOptionToGrab;
    };
    constructor(ssf: ISpiralFramework, node: Element, options: IQRCodeOptions);
    render(): void;
}
