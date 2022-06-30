export class DomHelpers {
    public static removeBaseUrl(html: string, projectBaseUrl?: string) {
        // remove <base> tag
        let newHtml = html.replace(/<base id="base" href=".+?">/, '');

        if (projectBaseUrl) {
            // remove base url prefixes from js and css assets
            newHtml = newHtml.replace(new RegExp(projectBaseUrl, 'g'), '');
            // remove iframe preview css
            newHtml = newHtml.replace(/<link rel="stylesheet" href="[a-z:\/0-9\.]+" id="preview-css">/, '');
        }

        return newHtml;
    }

    public static createLink(href: string, id?: string) {
        const link = document.createElement('link') as HTMLLinkElement;
        link.rel = 'stylesheet';
        link.href = href;
        if (id) link.id = id;
        return link;
    }

    public static createScript(src: string, id?: string) {
        const script = document.createElement('script');
        if(id) script.id = id;
        script.src = src;
        return script;
    }

    public static nodeFromString(html: string): HTMLElement {
        const div = document.createElement('div');
        div.innerHTML = html;
        return div.firstChild as HTMLElement;
    }

    /**
     * Check if node or its parent has content editable attribute.
     */
    public static nodeIsEditable(node: HTMLElement): boolean {
        if (node.nodeType !== Node.ELEMENT_NODE) return false;

        if (node.hasAttribute('contenteditable')) return true;

        const parent = node.parentElement;

        if ( ! parent || parent.nodeType !== Node.ELEMENT_NODE) return false;

        return parent.hasAttribute('contenteditable');
    }

    /**
     * Return whether or not given coordinates are above given element in the dom.
     */
    public static coordinatesAboveNode(node: HTMLElement, x: number, y: number): boolean {
        if (node.nodeName === '#text') return;

        let offset = node.getBoundingClientRect(),
            width = node.offsetWidth,
            height = node.offsetHeight;

        let box = [
            [offset.left, offset.top], //top left
            [offset.left + width, offset.top], //top right
            [offset.left + width, offset.top + height], //bottom right
            [offset.left, offset.top + height] //bottom left
        ];

        let beforePointY = box[0][1],
            beforePointX = box[0][0];

        if (y < box[2][1]) {
            return y < beforePointY || x < beforePointX
        }

        return false;
    }

    public static swapNodes(node1: HTMLElement, node2: HTMLElement) {
        if (node1.contains(node2) || node2.contains(node1)) return;

        // save the location of node2
        const parent2 = node2.parentElement;
        const next2 = node2.nextElementSibling;

        // special case for node1 is the next sibling of node2
        if (next2 === node1) {
            // just put node1 before node2
            parent2.insertBefore(node1, node2);
        } else {
            if ( ! node1.parentElement) return;

            // insert node2 right before node1
            node1.parentElement.insertBefore(node2, node1);

            // now insert node1 where node2 was
            if (next2) {
                // if there was an element after node2, then insert node1 right before that
                parent2.insertBefore(node1, next2);
            } else {
                // otherwise, just append as last child
                parent2.appendChild(node1);
            }
        }
    }

    public static reorderDom(newOrder: HTMLElement[], oldOrder: HTMLElement[]) {
        let swapped = [];

        newOrder.forEach((newNode, i) => {
            const positionChanged = oldOrder[i] !== newNode,
                current = oldOrder[i];

            if ( ! positionChanged || swapped.indexOf(current) > -1 || swapped.indexOf(newNode) > -1) return;

            DomHelpers.swapNodes(current, newNode);
            swapped.push(newNode);
        });
    }
}
